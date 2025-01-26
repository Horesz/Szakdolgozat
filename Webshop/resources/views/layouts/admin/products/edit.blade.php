@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Termék szerkesztése</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block font-medium">Termék neve</label>
            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded p-2" value="{{ old('name', $product->name) }}" required>
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- A többi mező ugyanaz, mint a create.blade.php-ben, az értékek pedig a $product objektumból jönnek -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Frissítés
        </button>
    </form>
</div>
@endsection
