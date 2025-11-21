@extends('layouts.default-layout')

@section('title', 'Edit Barang Keluar')

@section('content')
<h2 class="text-xl font-semibold mb-4">Edit Barang Keluar</h2>

@if(session('error'))
    <div class="bg-red-200 text-red-700 p-2 rounded mb-3">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('outgoing.update', $outgoing->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    {{-- PILIH BARANG --}}
    <div>
        <label class="font-semibold">Pilih Barang</label>
        <select name="item_id" class="w-full border p-2 rounded" required>
            @foreach($items as $item)
                <option value="{{ $item->id }}" 
                    {{ $outgoing->item_id == $item->id ? 'selected' : '' }}>
                    {{ $item->name }} (Stok: {{ $item->quantity }})
                </option>
            @endforeach
        </select>
    </div>

    {{-- JUMLAH --}}
    <div>
        <label class="font-semibold">Jumlah</label>
        <input type="number" 
               name="quantity" 
               value="{{ $outgoing->quantity }}" 
               class="w-full border p-2 rounded" 
               required>
    </div>

    {{-- KETERANGAN --}}
    <div>
        <label class="font-semibold">Keterangan</label>
        <textarea name="description" class="w-full border p-2 rounded">{{ $outgoing->description }}</textarea>
    </div>

    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Update
    </button>
</form>

@endsection
