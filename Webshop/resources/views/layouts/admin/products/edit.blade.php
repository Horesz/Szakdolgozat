@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Termék szerkesztése</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Termék neve</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategória</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Ár (Ft)</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Raktárkészlet</label>
            <input type="number" name="stock_quantity" class="form-control" value="{{ $product->stock_quantity }}" required>
        </div>

        <div class="mb-3">
            <label for="short_description" class="form-label">Rövid leírás</label>
            <textarea name="short_description" class="form-control" required>{{ $product->short_description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="full_description" class="form-label">Teljes leírás</label>
            <textarea name="full_description" class="form-control" required>{{ $product->full_description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Frissítés</button>
    </form>
</div>
@endsection
