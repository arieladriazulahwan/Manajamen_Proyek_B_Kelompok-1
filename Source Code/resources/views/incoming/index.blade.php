@extends('layouts.default-layout')

@section('title', 'Barang Masuk')

@section('content')
<div class="mb-4">
    <a href="{{ route('incoming.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">+ Tambah Barang Masuk</a>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-100 text-left">
        <tr>
            <th class="p-3">Nama Barang</th>
            <th class="p-3">Jumlah</th>
            <th class="p-3">Keterangan</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr class="border-b">
            <td class="p-3">{{ $item->item_name }}</td>
            <td class="p-3">{{ $item->quantity }}</td>
            <td class="p-3">{{ $item->description }}</td>
            <td class="p-3 space-x-2">
                <a href="{{ route('incoming.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('incoming.destroy', $item->id) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-500 hover:underline" onclick="return confirm('Hapus barang ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
