@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Új termék hozzáadása</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-medium">Termék neve</label>
            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded p-2" value="{{ old('name') }}" required>
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="category_id" class="block font-medium">Kategória</label>
            <select name="category_id" id="category_id" class="w-full border-gray-300 rounded p-2" required>
                <option value="">Válassz kategóriát</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="price" class="block font-medium">Ár (Ft)</label>
            <input type="number" name="price" id="price" class="w-full border-gray-300 rounded p-2" value="{{ old('price') }}" required>
            @error('price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="stock_quantity" class="block font-medium">Raktárkészlet</label>
            <input type="number" name="stock_quantity" id="stock_quantity" class="w-full border-gray-300 rounded p-2" value="{{ old('stock_quantity', 0) }}" required>
            @error('stock_quantity') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="type" class="block font-medium">Típus</label>
            <select name="type" id="type" class="w-full border-gray-300 rounded p-2" required>
                <option value="">Válassz típust</option>
                @foreach (['Konzol', 'Számítógép', 'Laptop', 'Perifériák', 'Játékszoftver', 'Kiegészítők'] as $type)
                    <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
            @error('type') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="images" class="block font-medium">Képek feltöltése</label>
            <input type="file" name="images[]" id="images" class="w-full border-gray-300 rounded p-2" multiple>
            @error('images.*') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Mentés
        </button>
    </form>
</div>
@endsection
