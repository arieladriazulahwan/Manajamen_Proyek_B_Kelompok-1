@extends('layouts.default-layout')

@section('title', 'Buat Pesanan')

@section('content')
<h2 class="text-2xl font-bold mb-4">Buat Pesanan</h2>

<form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label class="block font-medium">Tanggal Pesanan</label>
        <input type="date" name="order_date" class="w-full p-2 border rounded" required>
    </div>

    <div>
        <label class="block font-medium">Pilih Produk</label>
        <select name="products[]" multiple class="w-full p-2 border rounded">
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Buat Pesanan</button>
</form>
@endsection
