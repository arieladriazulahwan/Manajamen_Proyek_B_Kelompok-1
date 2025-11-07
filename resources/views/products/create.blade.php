@extends('layouts.default-layout')

@section('title', 'Tambah Produk')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Produk</h2>

<form action="{{ route('products.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="block font-medium">Nama Produk</label>
        <input type="text" name="name" class="w-full p-2 border rounded" required>
    </div>

    <div>
        <label class="block font-medium">Kategori</label>
        <select name="category_id" class="w-full p-2 border rounded" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-medium">Harga</label>
        <input type="number" name="price" class="w-full p-2 border rounded" required>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
