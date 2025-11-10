<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use App\Models\Outgoing;
use Illuminate\Http\Request;

class OutgoingController extends Controller
{
    public function index()
    {
        $items = Outgoing::all();
        return view('outgoing.index', compact('items'));
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

        // Ambil data dari Barang Masuk
        $incoming = Incoming::findOrFail($request->incoming_id);

        // Simpan ke Barang Keluar
        Outgoing::create([
            'item_name' => $incoming->item_name,
            'quantity' => $incoming->quantity,
            'description' => $incoming->description,
        ]);

        // Hapus dari Barang Masuk
        $incoming->delete();

        return redirect()->route('outgoing.index')->with('success', 'Barang berhasil dikeluarkan.');
    }

    public function edit(Outgoing $outgoing)
{
    $items = \App\Models\Incoming::all(); // Ambil semua data barang masuk
    return view('outgoing.edit', compact('outgoing', 'items'));
}



    public function destroy(Outgoing $outgoing)
    {
        $outgoing->delete();
        return redirect()->route('outgoing.index')->with('success', 'Barang keluar dihapus.');
    }
}
