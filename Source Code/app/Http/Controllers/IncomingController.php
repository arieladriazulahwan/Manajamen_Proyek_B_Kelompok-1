<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;

class IncomingController extends Controller
{
    public function index()
    {
        $items = Incoming::latest()->get();
        return view('incoming.index', compact('items'));
    }

    public function create()
    {
        return view('incoming.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        // Simpan ke tabel incomings
        $incoming = Incoming::create([
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        // Tambahkan ke tabel items
        $item = Item::create([
            'name' => $incoming->item_name,
            'quantity' => $incoming->quantity,
            'description' => $incoming->description,
            'incoming_id' => $incoming->id,
        ]);

        // 🔹 Jika tabel Products ada, tambahkan stok juga ke produk terkait
        if (class_exists(Product::class)) {
            $product = Product::where('name', $item->name)->first();
            if ($product) {
                $product->quantity += $request->quantity;
                $product->save();
            } else {
                // Product::create([
                //     'name' => $item->name,
                //     'quantity' => $item->quantity,
                //     // 'category_id' => null,
                //     // 'price' => 0,
                //     // 'description' => $item->description,
                // ]);
            }
        }

        return redirect()->route('incoming.index')->with('success', 'Barang masuk berhasil ditambahkan dan stok tersinkron di semua tabel.');
    }

    public function edit(Incoming $incoming)
    {
        return view('incoming.edit', compact('incoming'));
    }

    public function update(Request $request, Incoming $incoming)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $oldQuantity = $incoming->quantity;
        $oldName = $incoming->item_name;

        // Update incoming
        $incoming->update($request->only(['item_name', 'quantity', 'description']));

        // Update stok di items
        $item = Item::where('name', $oldName)->first();

        if ($item) {
            if ($oldName !== $request->item_name) {
                $item->quantity -= $oldQuantity;
                $item->save();

                $newItem = Item::where('name', $request->item_name)->first();
                if ($newItem) {
                    $newItem->quantity += $request->quantity;
                    $newItem->save();
                } else {
                    $newItem = Item::create([
                        'name' => $request->item_name,
                        'quantity' => $request->quantity,
                        'description' => $request->description,
                        'incoming_id' => $incoming->id,
                    ]);
                }
            } else {
                $difference = $request->quantity - $oldQuantity;
                $item->quantity += $difference;
                $item->save();
            }
        }

        // 🔹 Sinkronkan juga ke tabel Product jika ada
        if (class_exists(Product::class)) {
            $product = Product::where('name', $request->item_name)->first();
            if ($product) {
                $difference = $request->quantity - $oldQuantity;
                $product->quantity += $difference;
                $product->save();
            }
        }

        return redirect()->route('incoming.index')->with('success', 'Barang masuk dan stok berhasil diperbarui di semua tabel.');
    }

    public function destroy(Incoming $incoming)
    {
        $item = Item::where('name', $incoming->item_name)->first();

        if ($item) {
            $item->quantity -= $incoming->quantity;
            if ($item->quantity <= 0) {
                $item->delete();
            } else {
                $item->save();
            }
        }

        // 🔹 Kurangi quantity produk juga jika ada
        if (class_exists(Product::class)) {
            $product = Product::where('name', $incoming->item_name)->first();
            if ($product) {
                $product->quantity -= $incoming->quantity;
                if ($product->quantity <= 0) {
                    $product->delete();
                } else {
                    $product->save();
                }
            }
        }

        $incoming->delete();

        return redirect()->route('incoming.index')->with('success', 'Barang masuk dihapus dan stok diperbarui di semua tabel.');
    }
}
