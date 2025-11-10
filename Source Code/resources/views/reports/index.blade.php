{{-- resources/views/reports/index.blade.php --}}
<x-default-layout>
    <h1 class="text-xl font-bold mb-4 text-gray-800">Laporan Stok Barang</h1>

    <div class="bg-white shadow rounded p-4">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2">Kode</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Stok Saat Ini</th>
                    <th class="px-4 py-2">Barang Masuk</th>
                    <th class="px-4 py-2">Barang Keluar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $item->code }}</td>
                    <td class="px-4 py-2">{{ $item->name }}</td>
                    <td class="px-4 py-2">{{ $item->stock }}</td>
                    <td class="px-4 py-2">{{ $item->incoming_total ?? 0 }}</td>
                    <td class="px-4 py-2">{{ $item->outgoing_total ?? 0 }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-default-layout>
