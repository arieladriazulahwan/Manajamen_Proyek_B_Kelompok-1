<?php

namespace App\Http\Controllers;

use App\Models\Item; // ✅ PENTING: Tambahkan ini
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all(); // Ambil semua data dari tabel items
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        // Simpan data ke database
    }

    public function show($id)
    {
        // Tampilkan detail item
    }

    public function edit($id)
    {
        return view('items.edit');
    }

    public function update(Request $request, $id)
    {
        // Update data item
    }

    public function destroy($id)
    {
        // Hapus item
    }
}
