@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Termék szerkesztése</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Név</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ $product->slug }}" required>
            </div>

            <div class="form-group">
                <label for="description">Leírás</label>
                <textarea name="description" id="description" class="form-control" required>{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Ár</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
            </div>

            <div class="form-group">
                <label for="original_price">Eredeti ár</label>
                <input type="number" name="original_price" id="original_price" class="form-control" value="{{ $product->original_price }}">
            </div>

            <div class="form-group">
                <label for="discount">Kedvezmény (%)</label>
                <input type="number" name="discount" id="discount" class="form-control" value="{{ $product->discount }}">
            </div>

            <div class="form-group">
                <label for="category_id">Kategória</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="image">Kép</label>
                <input type="file" name="image" id="image" class="form-control">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-thumbnail mt-2" width="150">
                @endif
            </div>

            <div class="form-group">
                <label for="stock">Készlet</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}" required>
            </div>

            <div class="form-group">
                <label for="featured">Kiemelt termék</label>
                <input type="checkbox" name="featured" id="featured" {{ $product->featured ? 'checked' : '' }}>
            </div>

            <button type="submit" class="btn btn-warning">Frissítés</button>
        </form>
    </div>
@endsection
