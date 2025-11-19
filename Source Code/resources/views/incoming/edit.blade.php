@extends('layouts.default-layout')

@section('title', 'Edit Barang Masuk')

@section('content')
<h2 class="text-xl font-semibold mb-4">Edit Barang Masuk</h2>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('incoming.update', $incoming->id) }}" method="POST" class="space-y-4">
    @csrf 
    @method('PUT')

    <div>
        <label class="block mb-1 font-medium">Nama Barang</label>
        <input type="text" 
               name="name" 
               value="{{ old('name', $incoming->item_name ?? $incoming->name) }}" 
               class="w-full border p-2 rounded focus:ring focus:ring-blue-300" 
               required>
    </div>

    <div>
        <label class="block mb-1 font-medium">Jumlah</label>
        <input type="number" 
               name="quantity" 
               value="{{ old('quantity', $incoming->quantity) }}" 
               class="w-full border p-2 rounded focus:ring focus:ring-blue-300" 
               required>
    </div>

    <div>
        <label class="block mb-1 font-medium">Keterangan</label>
        <textarea name="description" 
                  class="w-full border p-2 rounded focus:ring focus:ring-blue-300" 
                  rows="3">{{ old('description', $incoming->description) }}</textarea>
    </div>

    <div class="flex justify-between items-center mt-4">
        <a href="{{ route('incoming.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
            Kembali
        </a>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Update
        </button>
    </div>
</form>
@endsection
