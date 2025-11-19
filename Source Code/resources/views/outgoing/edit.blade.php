@extends('layouts.default-layout')

@section('title', 'Edit Barang Keluar')

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Barang Keluar</h2>

<form action="{{ route('outgoing.update', $outgoing->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')

    <div>
        <label for="item_id" class="block font-medium">Nama Barang</label>
        <select name="item_id" id="item_id" class="w-full p-2 border rounded" required>
            @foreach ($items as $item)
                <option value="{{ $item->id }}" {{ $item->id == $outgoing->item_id ? 'selected' : '' }}>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="quantity" class="block font-medium">Jumlah</label>
        <input type="number" name="quantity" id="quantity" value="{{ $outgoing->quantity }}" class="w-full border p-2 rounded" required>
    </div>

    <div>
        <label for="description" class="block font-medium">Keterangan</label>
        <textarea name="description" id="description" class="w-full border p-2 rounded">{{ $outgoing->description }}</textarea>
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        Update Barang Keluar
    </button>
</form>
@endsection
