@extends('layouts.default-layout')

@section('title', 'Tambah Barang Keluar')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 shadow rounded-2xl">
    <h2 class="text-2xl font-semibold mb-4">Tambah Barang Keluar</h2>

    {{-- Notifikasi error jika stok tidak cukup --}}
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 mb-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Form utama --}}
    <form action="{{ route('outgoing.store') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Pilih Barang --}}
        <div>
            <label class="block font-medium mb-1">Pilih Barang</label>
            <select name="item_id" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->name }} (Stok: {{ $item->quantity }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Jumlah Barang Keluar --}}
        <div>
            <label class="block font-medium mb-1">Jumlah Keluar</label>
            <input type="number" name="quantity" class="w-full border p-2 rounded" min="1" required>
        </div>

        {{-- Keterangan --}}
        <div>
            <label class="block font-medium mb-1">Keterangan</label>
            <textarea name="description" class="w-full border p-2 rounded"></textarea>
        </div>

        {{-- Tombol Simpan --}}
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Simpan
        </button>
    </form>
</div>
@endsection
