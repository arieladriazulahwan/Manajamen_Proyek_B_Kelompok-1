@extends('layouts.default-layout')

@section('title', 'Dashboard Gudang')

@section('content')


    <h2 class="text-2xl font-bold">
        Dashboard Gudang
    </h2>


{{-- CARD STATISTIK --}}
<div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-6 gap-4">

    {{-- Total Barang --}}
    <div class="bg-white shadow rounded-xl p-5 border">
        <h3 class="text-gray-600">Total Barang</h3>
        <p class="text-3xl font-bold text-blue-600">
            {{ \App\Models\Item::count() }}
        </p>
    </div>

    {{-- Barang Masuk --}}
    <div class="bg-white shadow rounded-xl p-5 border">
        <h3 class="text-gray-600">Barang Masuk</h3>
        <p class="text-3xl font-bold text-green-600">
            {{ \App\Models\Incoming::count() }}
        </p>
    </div>

    {{-- Barang Keluar --}}
    <div class="bg-white shadow rounded-xl p-5 border">
        <h3 class="text-gray-600">Barang Keluar</h3>
        <p class="text-3xl font-bold text-red-600">
            {{ \App\Models\Outgoing::count() }}
        </p>
    </div>

    {{-- Kategori --}}
    <div class="bg-white shadow rounded-xl p-5 border">
        <h3 class="text-gray-600">Kategori</h3>
        <p class="text-3xl font-bold text-purple-600">
            {{ \App\Models\Category::count() }}
        </p>
    </div>

    {{-- Produk --}}
    <div class="bg-white shadow rounded-xl p-5 border">
        <h3 class="text-gray-600">Produk</h3>
        <p class="text-3xl font-bold text-orange-500">
            {{ \App\Models\Product::count() }}
        </p>
    </div>

    {{-- Pesanan --}}
    <div class="bg-white shadow rounded-xl p-5 border">
        <h3 class="text-gray-600">Pesanan</h3>
        <p class="text-3xl font-bold text-teal-600">
            {{ \App\Models\Order::count() }}
        </p>
    </div>

</div>

{{-- DESKRIPSI --}}
<div class="mt-8">
    <p class="text-gray-700 text-lg">
        Silakan kelola data barang, barang masuk, barang keluar, kategori, produk, dan pesanan melalui menu di samping.
    </p>
</div>

@endsection
