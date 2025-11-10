@extends('layouts.default-layout')

@section('title', 'Data Produk')

@section('content')
<div class="flex justify-between mb-4">
    <h2 class="text-2xl font-bold">Data Produk</h2>
    <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Produk</a>
</div>

<table class="min-w-full bg-white border">
    <thead>
        <tr>
            <th class="border px-4 py-2">Nama Produk</th>
            <th class="border px-4 py-2">Kategori</th>
            <th class="border px-4 py-2">Harga</th>
            <th class="border px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td class="border px-4 py-2">{{ $product->name }}</td>
            <td class="border px-4 py-2">{{ $product->category->name ?? '-' }}</td>
            <td class="border px-4 py-2">{{ number_format($product->price, 0, ',', '.') }}</td>
            <td class="border px-4 py-2 flex space-x-2">
                <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-400 px-3 py-1 rounded">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
