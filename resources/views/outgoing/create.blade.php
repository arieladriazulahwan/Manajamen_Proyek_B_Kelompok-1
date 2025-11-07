@extends('layouts.default-layout')

@section('title', 'Tambah Barang Keluar')

@section('content')
<h2 class="text-xl font-semibold mb-4">Tambah Barang Keluar</h2>
<form action="{{ route('outgoing.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label>Nama Barang</label>
        <select name="incoming_id" class="w-full border p-2 rounded" required>
            <option value="">-- Pilih Barang Masuk --</option>
            @foreach ($incomings as $incoming)
                <option value="{{ $incoming->id }}">{{ $incoming->item_name }} ({{ $incoming->quantity }})</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Pindahkan</button>
</form>
@endsection
