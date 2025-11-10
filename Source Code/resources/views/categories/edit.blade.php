@extends('layouts.default-layout')

@section('title', 'Edit Kategori')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Kategori</h2>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block mb-1 font-medium">Nama Kategori</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Update Kategori
        </button>
    </form>
@endsection
