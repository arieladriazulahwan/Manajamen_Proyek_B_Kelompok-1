@extends('layouts.default-layout')

@section('title', 'Data Pesanan')

@section('content')
<div class="flex justify-between mb-4">
    <h2 class="text-2xl font-bold">Data Pesanan</h2>
    <a href="{{ route('orders.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Buat Pesanan</a>
</div>

<table class="min-w-full bg-white border">
    <thead>
        <tr>
            <th class="border px-4 py-2">Tanggal Pesanan</th>
            <th class="border px-4 py-2">Produk</th>
            <th class="border px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td class="border px-4 py-2">{{ $order->order_date }}</td>
            <td class="border px-4 py-2">
                <ul>
                    @foreach ($order->products as $product)
                        <li>{{ $product->name }}</li>
                    @endforeach
                </ul>
            </td>
            <td class="border px-4 py-2 flex space-x-2">
                <a href="{{ route('orders.edit', $order->id) }}" class="bg-yellow-400 px-3 py-1 rounded">Edit</a>
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
