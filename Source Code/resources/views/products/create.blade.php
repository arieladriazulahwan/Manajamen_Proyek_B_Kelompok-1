@extends('layouts.default-layout')

@section('title', 'Tambah Produk')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Produk</h2>

<form action="{{ route('products.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="block font-medium">Pilih Item</label>
        <select name="item_id" class="w-full border p-2 rounded" required>
            @foreach ($items as $item)
                <option value="{{ $item->id }}">{{ $item->name }} (Stok: {{ $item->quantity }})</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-medium">Pilih Kategori</label>
        <select name="category_id" class="w-full border p-2 rounded" required>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-medium">Harga Produk</label>
        <input type="number" name="price" step="0.01" class="w-full border p-2 rounded" required>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
        Simpan Produk
    </button>
</form>
@endsection
