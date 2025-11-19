@extends('layouts.default-layout')

@section('title', 'Edit Produk')

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Produk</h2>

<form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')

    <div>
        <label for="item_id" class="block font-medium mb-1">Nama Item</label>
        <select name="item_id" id="item_id" class="w-full border rounded p-2" required>
            @foreach ($items as $item)
                <option value="{{ $item->id }}" {{ $product->name == $item->name ? 'selected' : '' }}>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="category_id" class="block font-medium mb-1">Kategori</label>
        <select name="category_id" id="category_id" class="w-full border rounded p-2" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="price" class="block font-medium mb-1">Harga</label>
        <input type="number" step="0.01" name="price" id="price" value="{{ $product->price }}" class="w-full border rounded p-2" required>
    </div>

    <div>
        <label for="quantity" class="block font-medium mb-1">Jumlah</label>
        <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}" class="w-full border rounded p-2" required>
    </div>

    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Simpan Perubahan
    </button>
    <a href="{{ route('products.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
</form>
@endsection
