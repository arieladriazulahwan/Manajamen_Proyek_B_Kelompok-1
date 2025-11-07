@extends('layouts.default-layout')

@section('title', 'Edit Produk')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Produk</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block mb-1 font-medium">Nama Produk</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="category_id" class="block mb-1 font-medium">Kategori</label>
            <select name="category_id" id="category_id" class="w-full border p-2 rounded" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Update Produk
        </button>
    </form>
@endsection
