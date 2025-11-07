@extends('layouts.default-layout')

@section('title', 'Data Kategori')

@section('content')
<div class="flex justify-between mb-4">
    <h2 class="text-2xl font-bold">Data Kategori</h2>
    <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Kategori</a>
</div>

<table class="min-w-full bg-white border">
    <thead>
        <tr>
            <th class="border px-4 py-2">Nama Kategori</th>
            <th class="border px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td class="border px-4 py-2">{{ $category->name }}</td>
            <td class="border px-4 py-2 flex space-x-2">
                <a href="{{ route('categories.edit', $category->id) }}" class="bg-yellow-400 px-3 py-1 rounded">Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
