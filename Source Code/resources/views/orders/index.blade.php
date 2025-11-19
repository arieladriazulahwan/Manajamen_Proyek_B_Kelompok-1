@extends('layouts.default-layout')

@section('title', 'Data Pesanan')

@section('content')
<div class="flex justify-between mb-4">
    <h2 class="text-2xl font-bold">Data Pesanan</h2>
    <a href="{{ route('orders.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Buat Pesanan</a>
</div>

<table class="min-w-full bg-white border">
    <thead class="bg-gray-100">
        <tr>
            <th class="border px-4 py-2">Tanggal Pesanan</th>
            <th class="border px-4 py-2">Produk</th>
            <th class="border px-4 py-2">Jumlah</th>
            <th class="border px-4 py-2">Harga (Rp)</th>
            <th class="border px-4 py-2">Total (Rp)</th>
            <th class="border px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($orders as $order)
            @php $grandTotal = 0; @endphp
            @foreach ($order->products as $product)
                @php 
                    $subtotal = ($product->pivot->quantity ?? 0) * ($product->pivot->price ?? 0);
                    $grandTotal += $subtotal;
                @endphp
                <tr>
                    @if ($loop->first)
                        <td class="border px-4 py-2" rowspan="{{ $order->products->count() }}">
                            {{ $order->order_date }}
                        </td>
                    @endif
                    <td class="border px-4 py-2">{{ $product->name }}</td>
                    <td class="border px-4 py-2 text-center">{{ $product->pivot->quantity ?? '-' }}</td>
                    <td class="border px-4 py-2 text-right">{{ number_format($product->pivot->price ?? 0, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2 text-right">{{ number_format($subtotal, 0, ',', '.') }}</td>
                    @if ($loop->first)
                        <td class="border px-4 py-2" rowspan="{{ $order->products->count() }}">
                            <div class="flex space-x-2">
                                <a href="{{ route('orders.edit', $order->id) }}" class="bg-yellow-400 px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                                </form>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
            <tr class="bg-gray-100 font-semibold">
                <td colspan="4" class="border px-4 py-2 text-right">Total Pesanan</td>
                <td class="border px-4 py-2 text-right">{{ number_format($grandTotal, 0, ',', '.') }}</td>
                <td class="border px-4 py-2"></td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-gray-500">Belum ada data pesanan.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
