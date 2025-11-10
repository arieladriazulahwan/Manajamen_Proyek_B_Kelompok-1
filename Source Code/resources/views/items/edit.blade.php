{{-- resources/views/items/edit.blade.php --}}
<x-default-layout>
    <h1 class="text-xl font-bold mb-4 text-gray-800">Edit Barang: {{ $item->name }}</h1>

    <form action="/items/{{ $item->id }}" method="POST" class="bg-white p-6 rounded shadow w-full max-w-lg">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="code" class="block text-sm font-medium text-gray-700">Kode Barang</label>
            <input type="text" name="code" id="code" value="{{ $item->code }}" class="w-full border-gray-300 rounded">
        </div>
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Barang</label>
            <input type="text" name="name" id="name" value="{{ $item->name }}" class="w-full border-gray-300 rounded">
        </div>
        <div class="mb-4">
            <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
            <input type="text" name="location" id="location" value="{{ $item->location }}" class="w-full border-gray-300 rounded">
        </div>
        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
    </form>
</x-default-layout>
