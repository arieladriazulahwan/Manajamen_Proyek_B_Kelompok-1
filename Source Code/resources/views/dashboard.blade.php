{{-- resources/views/dashboard.blade.php --}}
<x-default-layout>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-700 text-lg font-semibold">Total Barang</h2>
            <p class="text-2xl font-bold text-blue-600">1,245</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-700 text-lg font-semibold">Barang Masuk Hari Ini</h2>
            <p class="text-2xl font-bold text-green-600">38</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-700 text-lg font-semibold">Barang Keluar Hari Ini</h2>
            <p class="text-2xl font-bold text-red-600">21</p>
        </div>
    </div>
</x-default-layout>
