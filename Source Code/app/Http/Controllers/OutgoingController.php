<?php

namespace App\Http\Controllers;

use App\Models\Outgoing;
use App\Models\Item;
use Illuminate\Http\Request;

class OutgoingController extends Controller
{
    public function index()
    {
        $outgoings = Outgoing::latest()->get();
        return view('outgoing.index', compact('outgoings'));
    }

    public function create()
    {
        $items = Item::all();
        return view('outgoing.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $item = Item::findOrFail($request->item_id);

        if ($item->quantity < $request->quantity) {
            return back()->with('error', 'Stok barang tidak mencukupi!');
        }

        // Simpan ke tabel outgoings
        $outgoing = Outgoing::create([
            'item_id' => $item->id,
            'item_name' => $item->name,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        // Kurangi stok di tabel items
        $item->quantity -= $request->quantity;
        $item->save();

        return redirect()->route('outgoing.index')->with('success', 'Barang keluar berhasil disimpan dan stok diperbarui.');
    }

    public function edit(Outgoing $outgoing)
    {
        $items = Item::all();
        return view('outgoing.edit', compact('outgoing', 'items'));
    }

    public function update(Request $request, Outgoing $outgoing)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $oldItem = Item::find($outgoing->item_id);
        $newItem = Item::find($request->item_id);

        // Kembalikan stok lama
        if ($oldItem) {
            $oldItem->quantity += $outgoing->quantity;
            $oldItem->save();
        }

        // Pastikan stok cukup di item baru
        if ($newItem->quantity < $request->quantity) {
            return back()->with('error', 'Stok barang tidak mencukupi untuk perubahan!');
        }

        // Kurangi stok baru
        $newItem->quantity -= $request->quantity;
        $newItem->save();

        // Update data outgoing
        $outgoing->update([
            'item_id' => $newItem->id,
            'item_name' => $newItem->name,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('outgoing.index')->with('success', 'Data barang keluar berhasil diperbarui.');
    }

    public function destroy(Outgoing $outgoing)
    {
        $item = $outgoing->item;

        if ($item) {
            $item->quantity += $outgoing->quantity; // jika dihapus, stok dikembalikan
            $item->save();
        }

        $outgoing->delete();

        return redirect()->route('outgoing.index')->with('success', 'Barang keluar dihapus dan stok dikembalikan.');
    }
}
