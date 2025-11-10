{{-- resources/views/outgoing/create.blade.php --}}
<x-default-layout>
    <h1 class="text-xl font-bold mb-4 text-gray-800">Catat Barang Keluar</h1>

    <form action="/outgoing" method="POST" class="bg-white p-6 rounded shadow w-full max-w-lg">
        @csrf
        <div class="mb-4">
            <label for="item_id" class="block text-sm font-medium text-gray-700">Barang</label>
            <select name="item_id" id="item_id" class="w-full border-gray-300 rounded">
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input type="number" name="quantity" id="quantity" class="w-full border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label for="note" class="block text-sm font-medium text-gray-700">Catatan (Opsional)</label>
            <textarea name="note" id="note" class="w-full border-gray-300 rounded"></textarea>
        </div>
        <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Simpan</button>
    </form>
</x-default-layout>
