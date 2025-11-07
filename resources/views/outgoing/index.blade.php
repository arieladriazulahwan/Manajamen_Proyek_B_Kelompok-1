@extends('layouts.default-layout')

@section('title', 'Barang Keluar')

@section('content')
<div class="mb-4">
    <a href="{{ route('outgoing.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Tambah Barang Keluar</a>
</div>

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
        @foreach ($outgoings as $outgoing)
        <tr class="border-b">
            <td class="p-3">{{ $outgoing->item_name }}</td>
            <td class="p-3">{{ $outgoing->quantity }}</td>
            <td class="p-3">{{ $outgoing->description }}</td>
            <td class="p-3 space-x-2">
                <a href="{{ route('outgoing.edit', $outgoing->id) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('outgoing.destroy', $outgoing->id) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-500 hover:underline" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
