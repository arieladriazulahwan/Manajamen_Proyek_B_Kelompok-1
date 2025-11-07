@extends('layouts.default-layout')

@section('title', 'Data Barang di Gudang')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Data Barang di Gudang</h2>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($incomings->isEmpty())
        <p class="text-gray-500">Tidak ada barang di gudang saat ini.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded shadow">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border text-left">Nama Barang</th>
                        <th class="px-4 py-2 border text-left">Jumlah</th>
                        <th class="px-4 py-2 border text-left">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($incomings as $incoming)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $incoming->item_name }}</td>
                            <td class="px-4 py-2 border">{{ $incoming->quantity }}</td>
                            <td class="px-4 py-2 border">{{ $incoming->description ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
