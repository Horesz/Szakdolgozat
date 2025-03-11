@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="m-0 fs-4">Új termék hozzáadása</h2>
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

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

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
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="brand" class="form-label">Márka <span class="text-danger">*</span></label>
                                        <input type="text" name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}" required>
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
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                            <option value="">Válassz típust</option>
                                            @foreach(['Konzol', 'Számítógép', 'Laptop', 'Perifériák', 'Játékszoftver', 'Kiegészítők'] as $type)
                                                <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                            @endforeach
                                        </select>
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
                                    <textarea name="short_description" id="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="3" required>{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Maximum 255 karakter. Ez jelenik meg a terméklistákban.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="full_description" class="form-label">Teljes leírás <span class="text-danger">*</span></label>
                                    <textarea name="full_description" id="full_description" class="form-control @error('full_description') is-invalid @enderror" rows="6" required>{{ old('full_description') }}</textarea>
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
                                
                                <div id="imagePreview" class="row mt-3"></div>
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
                                        <option value="Aktív" {{ old('status') == 'Aktív' ? 'selected' : '' }}>Aktív</option>
                                        <option value="Inaktív" {{ old('status') == 'Inaktív' ? 'selected' : '' }}>Inaktív</option>
                                        <option value="Kifutó" {{ old('status') == 'Kifutó' ? 'selected' : '' }}>Kifutó</option>
                                        <option value="Hamarosan érkezik" {{ old('status') == 'Hamarosan érkezik' ? 'selected' : '' }}>Hamarosan érkezik</option>
                                        <option value="Elfogyott" {{ old('status') == 'Elfogyott' ? 'selected' : '' }}>Elfogyott</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">Kiemelt termék</label>
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_new_arrival" name="is_new_arrival" value="1" {{ old('is_new_arrival') ? 'checked' : '' }}>
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
                                        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="1" min="0" required>
                                        <span class="input-group-text">Ft</span>
                                    </div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="original_price" class="form-label">Eredeti ár (Ft)</label>
                                    <div class="input-group">
                                        <input type="number" name="original_price" id="original_price" class="form-control @error('original_price') is-invalid @enderror" value="{{ old('original_price') }}" step="1" min="0">
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
                                        <input type="number" name="discount_percentage" id="discount_percentage" class="form-control @error('discount_percentage') is-invalid @enderror" value="{{ old('discount_percentage') }}" min="0" max="100">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('discount_percentage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="stock_quantity" class="form-label">Raktárkészlet <span class="text-danger">*</span></label>
                                    <input type="number" name="stock_quantity" id="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" value="{{ old('stock_quantity') }}" min="0" required>
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
                                    <input type="number" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight') }}" step="0.01" min="0">
                                    @error('weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="warranty_months" class="form-label">Garancia (hónap)</label>
                                    <input type="number" name="warranty_months" id="warranty_months" class="form-control @error('warranty_months') is-invalid @enderror" value="{{ old('warranty_months') }}" min="0">
                                    @error('warranty_months')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-danger me-2">Mégsem</a>
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

        // Kép előnézet
        document.getElementById('images').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';
            
            Array.from(event.target.files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const colDiv = document.createElement('div');
                        colDiv.className = 'col-md-3 mb-3';
                        
                        const cardDiv = document.createElement('div');
                        cardDiv.className = 'card h-100';
                        
                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.className = 'card-img-top';
                        imgElement.alt = 'Előnézet';
                        imgElement.style.height = '120px';
                        imgElement.style.objectFit = 'cover';
                        
                        cardDiv.appendChild(imgElement);
                        colDiv.appendChild(cardDiv);
                        previewContainer.appendChild(colDiv);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    });
</script>
@endpush

@endsection