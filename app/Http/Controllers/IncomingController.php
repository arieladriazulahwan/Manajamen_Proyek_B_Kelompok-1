<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use Illuminate\Http\Request;

class IncomingController extends Controller
{
    public function index()
    {
        $items = Incoming::all();
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
        ]);

        Incoming::create($request->all());
        return redirect()->route('incoming.index')->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    public function edit(Incoming $incoming)
    {
        return view('incoming.edit', compact('incoming'));
    }

    public function update(Request $request, Incoming $incoming)
    {
        $request->validate([
            'item_name' => 'required',
            'quantity' => 'required|integer',
        ]);

        $incoming->update($request->all());
        return redirect()->route('incoming.index')->with('success', 'Barang masuk berhasil diperbarui.');
    }

    public function destroy(Incoming $incoming)
    {
        $incoming->delete();
        return redirect()->route('incoming.index')->with('success', 'Barang masuk berhasil dihapus.');
    }
}
