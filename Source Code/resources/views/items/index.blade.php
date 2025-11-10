{{-- resources/views/items/index.blade.php --}}
<x-default-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold text-gray-800">Data Barang</h1>
        <a href="/items/create" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">+ Tambah Barang</a>
    </div>

    <table class="w-full bg-white shadow rounded overflow-hidden">
        <thead class="bg-gray-100 text-left text-sm text-gray-600">
            <tr>
                <th class="px-4 py-2">Kode</th>
                <th class="px-4 py-2">Nama Barang</th>
                <th class="px-4 py-2">Stok</th>
                <th class="px-4 py-2">Lokasi</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @foreach ($items as $item)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $item->code }}</td>
                <td class="px-4 py-2">{{ $item->name }}</td>
                <td class="px-4 py-2">{{ $item->stock }}</td>
                <td class="px-4 py-2">{{ $item->location }}</td>
                <td class="px-4 py-2">
                    <a href="/items/{{ $item->id }}/edit" class="text-blue-600 hover:underline">Edit</a>
                    |
                    <form action="/items/{{ $item->id }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline" onclick="return confirm('Yakin?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-default-layout>
