
{{-- uj termék felvitele az adatbázisba --}}
@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 bg-white rounded-lg">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Új termék hozzáadása</h2>
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Termék neve</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="category_id" class="form-label">Kategória</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="price" class="form-label">Ár (Ft)</label>
                <input type="number" name="price" class="form-control" step="0.01" required>
            </div>
            
            <div class="mb-3">
                <label for="stock_quantity" class="form-label">Raktárkészlet</label>
                <input type="number" name="stock_quantity" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="type" class="form-label">Termék típusa</label>
                <select name="type" class="form-control" required>
                    <option value="Konzol">Konzol</option>
                    <option value="Számítógép">Számítógép</option>
                    <option value="Laptop">Laptop</option>
                    <option value="Perifériák">Perifériák</option>
                    <option value="Játékszoftver">Játékszoftver</option>
                    <option value="Kiegészítők">Kiegészítők</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="images" class="form-label">Képek</label>
                <input type="file" name="images[]" class="form-control" multiple>
                <div id="imagePreview" class="mt-2 grid grid-cols-3 gap-2"></div>
            </div>
            
            <div class="mb-3">
                <label for="short_description" class="form-label">Rövid leírás</label>
                <textarea name="short_description" class="form-control" required></textarea>
            </div>
            
            <div class="mb-3">
                <label for="full_description" class="form-label">Teljes leírás</label>
                <textarea name="full_description" class="form-control" required></textarea>
            </div>
            
            <div class="mb-3">
                <label for="meta_title" class="form-label">SEO Cím</label>
                <input type="text" name="meta_title" class="form-control">
            </div>
            
            <div class="mb-3">
                <label for="meta_description" class="form-label">SEO Leírás</label>
                <textarea name="meta_description" class="form-control"></textarea>
            </div>
            
            <div class="mb-3">
                <label for="meta_keywords" class="form-label">SEO Kulcsszavak (vesszővel elválasztva)</label>
                <input type="text" name="meta_keywords" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-success">Mentés</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelector('input[name="images[]"]').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('imagePreview');
        previewContainer.innerHTML = '';
        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.classList.add('w-24', 'h-24', 'object-cover', 'rounded-md');
                previewContainer.appendChild(imgElement);
            }
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection
