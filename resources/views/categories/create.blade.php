@extends('layouts.default-layout')

@section('title', 'Tambah Kategori')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Kategori</h2>

<form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="block font-medium">Nama Kategori</label>
        <input type="text" name="name" class="w-full p-2 border rounded" required>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
