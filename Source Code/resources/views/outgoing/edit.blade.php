@extends('layouts.default-layout')

@section('title', 'Edit Barang Keluar')

@section('content')
<form action="{{ route('outgoing.update', $outgoing->id) }}" method="POST" class="space-y-4 bg-white p-6 shadow rounded">
    @csrf
    @method('PUT')

    <div>
        <label for="item_name" class="block font-medium">Nama Barang</label>
        <select name="item_name" id="item_name" class="w-full p-2 border rounded">
            @foreach ($items as $item)
                <option value="{{ $item->item_name }}" {{ $item->item_name == $outgoing->item_name ? 'selected' : '' }}>
                    {{ $item->item_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="quantity" class="block font-medium">Jumlah</label>
        <input type="number" name="quantity" id="quantity" value="{{ $outgoing->quantity }}" class="w-full p-2 border rounded" required>
    </div>

    <div>
        <label for="description" class="block font-medium">Keterangan</label>
        <textarea name="description" id="description" class="w-full p-2 border rounded">{{ $outgoing->description }}</textarea>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
</form>
@endsection
