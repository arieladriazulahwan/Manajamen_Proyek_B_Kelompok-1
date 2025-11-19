<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use App\Models\Item;
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
        $item = \App\Models\Item::create([
            'name' => $incoming->item_name,
            'quantity' => $incoming->quantity,
            'description' => $incoming->description,
            'incoming_id' => $incoming->id,
        ]);

        // 🔹 Jika tabel Products ada, tambahkan stok juga ke produk terkait
        if (class_exists(\App\Models\Product::class)) {
            $product = \App\Models\Product::where('name', $item->name)->first();
            if ($product) {
                $product->stock += $request->quantity;
                $product->save();
            } else {
                // \App\Models\Product::create([
                //     'name' => $item->name,
                //     'stock' => $item->quantity,
                //     // 'category_id' => $item->i,
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
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $oldQuantity = $incoming->quantity;
        $oldName = $incoming->name;

        // Update incoming
        $incoming->update($request->all());

        // Update stok di items
        $item = Item::where('name', $oldName)->first();

        if ($item) {
            if ($oldName !== $request->name) {
                $item->quantity -= $oldQuantity;
                $item->save();

                $newItem = Item::where('name', $request->name)->first();
                if ($newItem) {
                    $newItem->quantity += $request->quantity;
                    $newItem->save();
                } else {
                    $newItem = Item::create([
                        'name' => $request->name,
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
        if (class_exists(\App\Models\Product::class)) {
            $product = \App\Models\Product::where('name', $request->name)->first();
            if ($product) {
                $difference = $request->quantity - $oldQuantity;
                $product->stock += $difference;
                $product->save();
            }
        }

        return redirect()->route('incoming.index')->with('success', 'Barang masuk dan stok berhasil diperbarui di semua tabel.');
    }

    public function destroy(Incoming $incoming)
    {
        $item = Item::where('name', $incoming->name)->first();

        if ($item) {
            $item->quantity -= $incoming->quantity;
            if ($item->quantity <= 0) {
                $item->delete();
            } else {
                $item->save();
            }
        }

        // 🔹 Kurangi stok produk juga jika ada
        if (class_exists(\App\Models\Product::class)) {
            $product = \App\Models\Product::where('name', $incoming->name)->first();
            if ($product) {
                $product->stock -= $incoming->quantity;
                if ($product->stock <= 0) {
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
