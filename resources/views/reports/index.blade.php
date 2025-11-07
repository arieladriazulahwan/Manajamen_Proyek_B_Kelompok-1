@extends('layouts.default-layout')

@section('title', 'Laporan Gudang')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Laporan Gudang</h2>

    {{-- Barang Masuk --}}
    <div class="mb-10">
        <h3 class="text-xl font-semibold mb-2">Barang Masuk</h3>
        <table class="w-full bg-white border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nama Barang</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">Deskripsi</th>
                    <th class="px-4 py-2 border">Tanggal Masuk</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($incomings as $incoming)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $incoming->item_name }}</td>
                        <td class="px-4 py-2 border">{{ $incoming->quantity }}</td>
                        <td class="px-4 py-2 border">{{ $incoming->description ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $incoming->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Barang Keluar --}}
    <div class="mb-10">
        <h3 class="text-xl font-semibold mb-2">Barang Keluar</h3>
        <table class="w-full bg-white border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nama Barang</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">Deskripsi</th>
                    <th class="px-4 py-2 border">Tanggal Keluar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($outgoings as $outgoing)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $outgoing->item_name }}</td>
                        <td class="px-4 py-2 border">{{ $outgoing->quantity }}</td>
                        <td class="px-4 py-2 border">{{ $outgoing->description ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $outgoing->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Barang Saat Ini --}}
    <div>
        <h3 class="text-xl font-semibold mb-2">Stok Barang Saat Ini</h3>
        <table class="w-full bg-white border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nama Barang</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">Deskripsi</th>
                    <th class="px-4 py-2 border">Tanggal Tercatat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $item->name }}</td>
                        <td class="px-4 py-2 border">{{ $item->quantity }}</td>
                        <td class="px-4 py-2 border">{{ $item->description ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $item->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Categories --}}
    <div class="mb-10">
        <h3 class="text-xl font-semibold mb-3">Data Kategori</h3>
        <table class="min-w-full bg-white border border-gray-300 mb-6">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Nama Kategori</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $category->id }}</td>
                        <td class="px-4 py-2 border">{{ $category->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Products --}}
    <div class="mb-10">
        <h3 class="text-xl font-semibold mb-3">Data Produk</h3>
        <table class="min-w-full bg-white border border-gray-300 mb-6">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Nama Produk</th>
                    <th class="px-4 py-2 border">Kategori</th>
                    <th class="px-4 py-2 border">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $product->id }}</td>
                        <td class="px-4 py-2 border">{{ $product->name }}</td>
                        <td class="px-4 py-2 border">{{ $product->category->name ?? '-' }}</td>
                        <td class="px-4 py-2 border">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Orders --}}
    <div class="mb-10">
        <h3 class="text-xl font-semibold mb-3">Data Pesanan</h3>
        <table class="min-w-full bg-white border border-gray-300 mb-6">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">ID Pesanan</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Total Produk</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $order->id }}</td>
                        <td class="px-4 py-2 border">{{ $order->created_at->format('d-m-Y') }}</td>
                        <td class="px-4 py-2 border">{{ $order->products->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



@endsection
