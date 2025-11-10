@extends('layouts.default-layout')

@section('title', 'Edit Barang Masuk')

@section('content')
<h2 class="text-xl font-semibold mb-4">Edit Barang Masuk</h2>
<form action="{{ route('incoming.update', $incoming->id) }}" method="POST" class="space-y-4">
    @csrf @method('PUT')
    <div>
        <label>Nama Barang</label>
        <input type="text" name="item_name" value="{{ $incoming->item_name }}" class="w-full border p-2 rounded" required>
    </div>
    <div>
        <label>Jumlah</label>
        <input type="number" name="quantity" value="{{ $incoming->quantity }}" class="w-full border p-2 rounded" required>
    </div>
    <div>
        <label>Keterangan</label>
        <textarea name="description" class="w-full border p-2 rounded">{{ $incoming->description }}</textarea>
    </div>
    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
</form>
@endsection
