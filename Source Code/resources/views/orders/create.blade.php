@extends('layouts.default-layout')

@section('title', 'Buat Pesanan')

@section('content')
<h2 class="text-2xl font-bold mb-4">Buat Pesanan</h2>

<form action="{{ route('orders.store') }}" method="POST" class="space-y-6">
    @csrf

    <div>
        <label class="block font-medium">Nama Pelanggan</label>
        <input type="text" name="customer_name" class="w-full p-2 border rounded" required>
    </div>

    <div>
        <label class="block font-medium">Tanggal Pesanan</label>
        <input type="date" name="order_date" class="w-full p-2 border rounded" required>
    </div>

    <div>
        <label class="block font-medium mb-2">Pilih Produk & Jumlah</label>

        <div id="product-list" class="space-y-3">
            @foreach ($products as $product)
                <div class="flex items-center justify-between border p-3 rounded">
                    <div>
                        <p class="font-semibold">{{ $product->name }}</p>
                        <p class="text-sm text-gray-600">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600">Stok: {{ $product->item->quantity ?? 0 }}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="products[{{ $product->id }}][selected]" value="1">
                        <input 
                            type="number" 
                            name="products[{{ $product->id }}][quantity]" 
                            min="0" 
                            class="w-20 border rounded p-1 text-center" 
                            placeholder="Qty">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="pt-4">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Simpan Pesanan
        </button>
        <a href="{{ route('orders.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
</form>
@endsection
