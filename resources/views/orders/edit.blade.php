@extends('layouts.default-layout')

@section('title', 'Edit Pesanan')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Pesanan</h2>

    <form action="{{ route('orders.update', $order->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label for="product_id" class="block mb-1 font-medium">Pilih Produk</label>
            <select name="product_id" id="product_id" class="w-full border p-2 rounded">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $product->id == $order->product_id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="quantity" class="block mb-1 font-medium">Jumlah</label>
            <input type="number" name="quantity" id="quantity" value="{{ $order->quantity }}" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Update Pesanan
        </button>
    </form>
@endsection
