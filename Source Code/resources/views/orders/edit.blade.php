@extends('layouts.default-layout')

@section('title', 'Edit Pesanan')

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Pesanan</h2>

<form action="{{ route('orders.update', $order->id) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-medium">Nama Pelanggan</label>
        <input type="text" value="{{ $order->customer_name }}" class="w-full p-2 border rounded bg-gray-100" disabled>
    </div>

    <div>
        <label class="block font-medium mb-2">Produk dalam Pesanan</label>

        <div class="space-y-3">
            @foreach ($products as $product)
                @php
                    $pivot = $order->products->where('id', $product->id)->first()?->pivot;
                @endphp

                <div class="flex items-center justify-between border p-3 rounded">
                    <div>
                        <p class="font-semibold">{{ $product->name }}</p>
                        <p class="text-sm text-gray-600">Kategori: {{ $product->category->name ?? '-' }}</p>
                        <p class="text-sm text-gray-600">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600">Stok: {{ $product->item->quantity ?? 0 }}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="products[{{ $product->id }}][selected]" value="1"
                            {{ $pivot ? 'checked' : '' }}>
                        <input type="number" name="products[{{ $product->id }}][quantity]"
                            value="{{ $pivot->quantity ?? 0 }}" min="0"
                            class="w-20 border rounded p-1 text-center">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="pt-4">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Simpan Perubahan
        </button>
        <a href="{{ route('orders.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
</form>
@endsection
