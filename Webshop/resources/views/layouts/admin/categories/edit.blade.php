@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="m-0 text-black fs-4">Kategória szerkesztése: {{ $category->name }}</h2>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Vissza a kategóriákhoz
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

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <!-- Alapadatok -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Kategória alapadatai</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Kategória neve <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $category->slug) }}" required>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Ez jelenik meg az URL-ben. Csak kisbetűket, számokat és kötőjeleket használjon.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Leírás</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $category->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Kapcsolódó termékek -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Kapcsolódó termékek</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Termékek ebben a kategóriában: <strong>{{ $category->products->count() }}</strong></span>
                                    <a href="{{ route('admin.products.index', ['category_id' => $category->id]) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-external-link-alt me-1"></i>Termékek megtekintése
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Kép feltöltés -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Kategória képe</h5>
                            </div>
                            <div class="card-body">
                                <!-- Jelenlegi kép -->
                                @if($category->image)
                                    <div class="text-center mb-3">
                                        <p class="mb-2">Jelenlegi kép:</p>
                                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="image" class="form-label">Új kép feltöltése</label>
                                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Hagyja üresen, ha nem szeretné módosítani.</small>
                                </div>
                                
                                <div id="imagePreview" class="mt-3 text-center"></div>

                                @if($category->image)
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                                        <label class="form-check-label" for="remove_image">
                                            Kép eltávolítása
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Állapot -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Kategória állapota</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Állapot <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="active" {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>Aktív</option>
                                        <option value="inactive" {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>Inaktív</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Információk -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Információk</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between px-0">
                                        <span>Létrehozva:</span>
                                        <span>{{ $category->created_at->format('Y.m.d. H:i') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between px-0">
                                        <span>Utoljára módosítva:</span>
                                        <span>{{ $category->updated_at->format('Y.m.d. H:i') }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-danger me-2">Mégsem</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Módosítások mentése
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Kép előnézet
        document.getElementById('image').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';
            
            if (event.target.files && event.target.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const imgContainer = document.createElement('div');
                    imgContainer.className = 'border rounded p-2';
                    
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.className = 'img-fluid';
                    imgElement.style.maxHeight = '150px';
                    
                    imgContainer.appendChild(imgElement);
                    previewContainer.appendChild(imgContainer);
                }
                
                reader.readAsDataURL(event.target.files[0]);
            }
        });

        // Ha a "Kép eltávolítása" be van jelölve, tiltsa le a kép feltöltést
        const removeImageCheckbox = document.getElementById('remove_image');
        if (removeImageCheckbox) {
            removeImageCheckbox.addEventListener('change', function() {
                const imageInput = document.getElementById('image');
                if (this.checked) {
                    imageInput.disabled = true;
                    imageInput.value = '';
                    document.getElementById('imagePreview').innerHTML = '';
                } else {
                    imageInput.disabled = false;
                }
            });
        }
    });
</script>
@endpush

@endsection