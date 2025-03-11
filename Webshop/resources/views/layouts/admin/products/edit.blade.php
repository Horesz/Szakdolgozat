@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="m-0 fs-4">Termék szerkesztése</h2>
                <a href="{{ route('admin.products.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Vissza a termékekhez
                </a>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Hiba!</strong> Kérjük, ellenőrizd az alábbi mezőket:
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <!-- Alapadatok -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Termék alapadatai</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Termék neve <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="brand" class="form-label">Márka <span class="text-danger">*</span></label>
                                        <input type="text" name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand', $product->brand) }}" required>
                                        @error('brand')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="category_id" class="form-label">Kategória <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                            <option value="">Válassz kategóriát</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="type" class="form-label">Típus <span class="text-danger">*</span></label>
                                        <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type', $product->type) }}" required>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Leírások -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Termék leírása</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Rövid leírás <span class="text-danger">*</span></label>
                                    <textarea name="short_description" id="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="3" required>{{ old('short_description', $product->short_description) }}</textarea>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Maximum 255 karakter. Ez jelenik meg a terméklistákban.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="full_description" class="form-label">Teljes leírás <span class="text-danger">*</span></label>
                                    <textarea name="full_description" id="full_description" class="form-control @error('full_description') is-invalid @enderror" rows="6" required>{{ old('full_description', $product->full_description) }}</textarea>
                                    @error('full_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Képek -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Termék képek</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="images" class="form-label">Képek feltöltése</label>
                                    <input type="file" name="images[]" id="images" class="form-control @error('images') is-invalid @enderror" multiple accept="image/*">
                                    @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Többszörös kiválasztás lehetséges. Az első kép lesz a fő kép.</small>
                                </div>

                                <!-- Meglévő képek megjelenítése -->
                                <div class="row mt-3">
                                    @php
                                        $images = [];
                                        if (method_exists($product, 'images')) {
                                            $images = $product->images()->get();
                                        }
                                    @endphp
                                    
                                    @forelse($images as $image)
                                        <div class="col-md-3 mb-3">
                                            <div class="card h-100">
                                                <img src="{{ $image->image_path }}" class="card-img-top" alt="Termék kép" style="height: 120px; object-fit: cover;">
                                                <div class="card-body p-2 text-center">
                                                    @if($image->is_primary)
                                                        <span class="badge bg-success mb-1">Fő kép</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-info mb-0">
                                                Még nincs feltöltve kép a termékhez.
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Állapot és láthatóság -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Állapot és láthatóság</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Állapot <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="Aktív" {{ old('status', $product->status) == 'Aktív' ? 'selected' : '' }}>Aktív</option>
                                        <option value="Inaktív" {{ old('status', $product->status) == 'Inaktív' ? 'selected' : '' }}>Inaktív</option>
                                        <option value="Elfogyott" {{ old('status', $product->status) == 'Elfogyott' ? 'selected' : '' }}>Elfogyott</option>
                                        <option value="Hamarosan érkezik" {{ old('status', $product->status) == 'Hamarosan érkezik' ? 'selected' : '' }}>Hamarosan érkezik</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">Kiemelt termék</label>
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_new_arrival" name="is_new_arrival" value="1" {{ old('is_new_arrival', $product->is_new_arrival) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_new_arrival">Új termék</label>
                                </div>
                            </div>
                        </div>

                        <!-- Árazás -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Árazás és készlet</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Aktuális ár (Ft) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" step="1" min="0" required>
                                        <span class="input-group-text">Ft</span>
                                    </div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="original_price" class="form-label">Eredeti ár (Ft)</label>
                                    <div class="input-group">
                                        <input type="number" name="original_price" id="original_price" class="form-control @error('original_price') is-invalid @enderror" value="{{ old('original_price', $product->original_price) }}" step="1" min="0">
                                        <span class="input-group-text">Ft</span>
                                    </div>
                                    @error('original_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Eredeti ár megadása esetén a kedvezmény megjelenik a terméklistában.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="discount_percentage" class="form-label">Kedvezmény (%)</label>
                                    <div class="input-group">
                                        <input type="number" name="discount_percentage" id="discount_percentage" class="form-control @error('discount_percentage') is-invalid @enderror" value="{{ old('discount_percentage', $product->discount_percentage) }}" min="0" max="100">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('discount_percentage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="stock_quantity" class="form-label">Raktárkészlet <span class="text-danger">*</span></label>
                                    <input type="number" name="stock_quantity" id="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" value="{{ old('stock_quantity', $product->stock_quantity) }}" min="0" required>
                                    @error('stock_quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Műszaki adatok -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Egyéb adatok</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="weight" class="form-label">Súly (kg)</label>
                                    <input type="number" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', $product->weight) }}" step="0.01" min="0">
                                    @error('weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="warranty_months" class="form-label">Garancia (hónap)</label>
                                    <input type="number" name="warranty_months" id="warranty_months" class="form-control @error('warranty_months') is-invalid @enderror" value="{{ old('warranty_months', $product->warranty_months) }}" min="0">
                                    @error('warranty_months')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary me-2">Mégsem</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Termék mentése
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Automatikus kedvezmény számítás
        const priceInput = document.getElementById('price');
        const originalPriceInput = document.getElementById('original_price');
        const discountPercentageInput = document.getElementById('discount_percentage');

        function calculateDiscount() {
            const price = parseFloat(priceInput.value) || 0;
            const originalPrice = parseFloat(originalPriceInput.value) || 0;
            
            if (originalPrice > 0 && price > 0 && originalPrice > price) {
                const discount = Math.round((1 - (price / originalPrice)) * 100);
                discountPercentageInput.value = discount;
            }
        }

        priceInput.addEventListener('change', calculateDiscount);
        originalPriceInput.addEventListener('change', calculateDiscount);
    });
</script>
@endpush

@endsection