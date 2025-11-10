@extends('layouts.default-layout')

@section('title', 'Tambah Barang Masuk')

@section('content')
<h2 class="text-xl font-semibold mb-4">Tambah Barang Masuk</h2>
<form action="{{ route('incoming.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label>Nama Barang</label>
        <input type="text" name="item_name" class="w-full border p-2 rounded" required>
    </div>
    <div>
        <label>Jumlah</label>
        <input type="number" name="quantity" class="w-full border p-2 rounded" required>
    </div>
    <div>
        <label>Keterangan</label>
        <textarea name="description" class="w-full border p-2 rounded"></textarea>
    </div>
    <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
</form>
@endsection
