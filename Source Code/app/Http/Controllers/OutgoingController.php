<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use App\Models\Outgoing;
use Illuminate\Http\Request;

class OutgoingController extends Controller
{
    public function index()
    {
        // Ambil semua data outgoing
        $outgoings = Outgoing::all();
        // Kirim data ke view
        return view('outgoing.index', compact('outgoings'));
    }

    public function create()
    {
        // Menampilkan data dari Incoming yang tersedia
        $incomings = Incoming::all();
        return view('outgoing.create', compact('incomings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'incoming_id' => 'required|exists:incomings,id',
        ]);

        $incoming = Incoming::findOrFail($request->incoming_id);

        Outgoing::create([
            'item_name' => $incoming->item_name,
            'quantity' => $incoming->quantity,
            'description' => $incoming->description,
        ]);

        $incoming->delete();

        return redirect()->route('outgoing.index')->with('success', 'Barang berhasil dipindahkan ke Barang Keluar.');
    }
    public function incoming()
    {
        return $this->belongsTo(\App\Models\Incoming::class, 'item_id');
    }


    public function edit(Outgoing $outgoing)
    {
        $items = \App\Models\Incoming::all(); // Ambil semua barang masuk
        return view('outgoing.edit', compact('outgoing', 'items'));
    }

    public function update(Request $request, Outgoing $outgoing)
    {
        $request->validate([
            'item_name' => 'required|string',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
        ]);
    
        // 1. Kembalikan data sebelumnya ke Incoming
        Incoming::create([
            'item_name' => $outgoing->item_name,
            'quantity' => $outgoing->quantity,
            'description' => $outgoing->description,
        ]);
    
        // 2. Update data Outgoing
        $outgoing->update([
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);
    
        return redirect()->route('outgoing.index')->with('success', 'Data barang keluar berhasil diperbarui dan data sebelumnya dikembalikan ke barang masuk.');
    }    



    public function destroy(Outgoing $outgoing)
    {
        $outgoing->delete();
        return redirect()->route('outgoing.index')->with('success', 'Barang keluar dihapus.');
    }
}
