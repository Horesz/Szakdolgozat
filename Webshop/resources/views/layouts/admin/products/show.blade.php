@extends('layouts.app')

@section('title', $product->name . ' - GamerShop')

@section('content')
<div class="bg-light py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Főoldal</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.browse') }}">Termékek</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.browse', ['category' => $product->category_id]) }}">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
        
        <div class="row">
            <!-- Termék képek -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="product-gallery">
                    <div class="main-image-container mb-3">
                        @if($product->images()->exists())
                            <img src="{{ asset($product->images()->where('is_primary', 1)->first()->image_path) }}" 
                                 id="main-product-image" class="img-fluid rounded shadow" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('images/no-image.jpg') }}" 
                                 class="img-fluid rounded shadow" alt="No Image">
                        @endif
                    </div>
                    
                    @if($product->images()->count() > 1)
                        <div class="row g-2 thumbnail-gallery">
                            @foreach($product->images as $image)
                                <div class="col-3">
                                    <div class="thumbnail-container {{ $image->is_primary ? 'active' : '' }}" 
                                         data-src="{{ asset($image->image_path) }}">
                                        <img src="{{ asset($image->image_path) }}" 
                                             class="img-fluid rounded thumbnail-image" alt="{{ $product->name }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Termék információk -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h1 class="product-title h3 fw-bold mb-2">{{ $product->name }}</h1>
                        
                        <div class="product-meta mb-3">
                            <span class="badge bg-secondary me-2">{{ $product->category->name }}</span>
                            <span class="badge bg-primary me-2">{{ $product->brand }}</span>
                            @if($product->is_new_arrival)
                                <span class="badge bg-success me-2">Új termék</span>
                            @endif
                            @if($product->is_featured)
                                <span class="badge bg-info me-2">Kiemelt</span>
                            @endif
                        </div>
                        
                        <div class="product-description mb-4">
                            <p>{{ $product->short_description }}</p>
                        </div>
                        
                        <div class="product-price-section mb-4">
                            @if($product->original_price > $product->price)
                                <div class="d-flex align-items-center">
                                    <span class="text-muted text-decoration-line-through me-2">
                                        {{ number_format($product->original_price, 0, ',', ' ') }} Ft
                                    </span>
                                    <span class="fs-4 fw-bold text-danger">
                                        {{ number_format($product->price, 0, ',', ' ') }} Ft
                                    </span>
                                    <span class="badge bg-danger ms-2">
                                        -{{ round((1 - $product->price / $product->original_price) * 100) }}%
                                    </span>
                                </div>
                            @else
                                <span class="fs-4 fw-bold">
                                    {{ number_format($product->price, 0, ',', ' ') }} Ft
                                </span>
                            @endif
                        </div>
                        
                        <div class="product-availability mb-4">
                            @if($product->stock_quantity > 10)
                                <div class="text-success">
                                    <i class="fas fa-check-circle me-1"></i>Raktáron ({{ $product->stock_quantity }} db)
                                </div>
                            @elseif($product->stock_quantity > 0)
                                <div class="text-warning">
                                    <i class="fas fa-exclamation-circle me-1"></i>Utolsó darabok ({{ $product->stock_quantity }} db)
                                </div>
                            @else
                                <div class="text-danger">
                                    <i class="fas fa-times-circle me-1"></i>Nincs raktáron
                                </div>
                            @endif
                        </div>
                        
                        <!-- Kosárhoz adás -->
                        <form class="mb-4">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-secondary quantity-btn" data-action="decrease">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" id="quantity" class="form-control text-center" value="1" min="1" max="{{ $product->stock_quantity }}">
                                        <button type="button" class="btn btn-outline-secondary quantity-btn" data-action="increase">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <button type="button" class="btn btn-primary w-100 add-to-cart-btn" data-product-id="{{ $product->id }}">
                                        <i class="fas fa-shopping-cart me-2"></i>Kosárba
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                        <!-- Egyéb információk -->
                        <div class="product-info mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-tag text-primary me-2"></i>
                                            <strong>Márka:</strong> {{ $product->brand }}
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-folder text-primary me-2"></i>
                                            <strong>Kategória:</strong> {{ $product->category->name }}
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-weight text-primary me-2"></i>
                                            <strong>Súly:</strong> {{ $product->weight ?? '-' }} kg
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-shipping-fast text-primary me-2"></i>
                                            <strong>Szállítás:</strong> 1-3 munkanap
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-undo text-primary me-2"></i>
                                            <strong>Visszaküldés:</strong> 14 nap
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-shield-alt text-primary me-2"></i>
                                            <strong>Garancia:</strong> {{ $product->warranty_months ?? '24' }} hónap
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Megosztás -->
                        <div class="product-share-buttons">
                            <div class="d-flex align-items-center">
                                <span class="me-3">Megosztás:</span>
                                <div class="social-icons">
                                    <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" class="btn btn-sm btn-outline-primary me-2" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($product->name) }}" class="btn btn-sm btn-outline-info me-2" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="mailto:?subject={{ urlencode($product->name) }}&body={{ urlencode(request()->url()) }}" class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger copy-link-btn" data-url="{{ request()->url() }}">
                                        <i class="fas fa-link"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Termék részletek Tab-ok -->
        <div class="product-details mt-5">
            <ul class="nav nav-tabs" id="productTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description-tab-pane" type="button" role="tab" aria-controls="description-tab-pane" aria-selected="true">
                        Leírás
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs-tab-pane" type="button" role="tab" aria-controls="specs-tab-pane" aria-selected="false">
                        Specifikációk
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-tab-pane" type="button" role="tab" aria-controls="reviews-tab-pane" aria-selected="false">
                        Értékelések (0)
                    </button>
                </li>
            </ul>
            <div class="tab-content p-4 bg-white shadow-sm rounded-bottom" id="productTabsContent">
                <div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel" aria-labelledby="description-tab" tabindex="0">
                    <div class="product-description">
                        {!! nl2br(e($product->full_description)) !!}
                    </div>
                </div>
                <div class="tab-pane fade" id="specs-tab-pane" role="tabpanel" aria-labelledby="specs-tab" tabindex="0">
                    @if($product->specifications)
                        <div class="product-specifications">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        @foreach($product->specifications as $key => $value)
                                            <tr>
                                                <th style="width: 30%">{{ $key }}</th>
                                                <td>{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>A termékhez nem tartoznak részletes specifikációk.
                        </div>
                    @endif
                </div>
                <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">
                    <div class="product-reviews">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Ehhez a termékhez még nem érkezett értékelés. Legyél te az első!
                        </div>
                        
                        <!-- Értékelés űrlap -->
                        <div class="review-form-container mt-4">
                            <h4 class="mb-3">Értékeld a terméket</h4>
                            <form action="{{ route('products.review', $product->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Értékelés</label>
                                    <div class="rating-stars">
                                        <div class="d-flex">
                                            @for($i = 5; $i >= 1; $i--)
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="rating" id="rating{{ $i }}" value="{{ $i }}">
                                                    <label class="form-check-label" for="rating{{ $i }}">
                                                        {{ $i }} <i class="fas fa-star text-warning"></i>
                                                    </label>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Cím</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Vélemény</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Értékelés küldése</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Kapcsolódó termékek -->
        <div class="related-products mt-5">
            <h3 class="mb-4">Hasonló termékek</h3>
            <div class="row g-4">
                @foreach($relatedProducts ?? [] as $relatedProduct)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm product-card">
                            <div class="position-relative product-img-wrapper">
                                @if($relatedProduct->images()->exists())
                                    <img src="{{ asset($relatedProduct->images()->where('is_primary', 1)->first()->image_path) }}" 
                                         class="card-img-top" alt="{{ $relatedProduct->name }}">
                                @else
                                    <img src="{{ asset('images/no-image.jpg') }}" 
                                         class="card-img-top" alt="No Image">
                                @endif
                                
                                @if($relatedProduct->original_price > $relatedProduct->price)
                                    <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 m-2 rounded-pill">
                                        <i class="fas fa-fire-alt me-1"></i>-{{ round((1 - $relatedProduct->price / $relatedProduct->original_price) * 100) }}%
                                    </div>
                                @endif
                                
                                <div class="product-actions">
                                    <a href="{{ route('products.show', $relatedProduct->id) }}" class="btn btn-outline-light btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="btn btn-primary btn-sm add-to-cart" 
                                            data-product-id="{{ $relatedProduct->id }}">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold product-name">{{ $relatedProduct->name }}</h5>
                                <p class="card-text text-muted small product-desc">{{ Str::limit($relatedProduct->short_description, 60) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="product-price">
                                        @if($relatedProduct->original_price > $relatedProduct->price)
                                            <span class="text-muted text-decoration-line-through small">
                                                {{ number_format($relatedProduct->original_price, 0, ',', ' ') }} Ft
                                            </span>
                                            <span class="ms-2 text-danger fw-bold">
                                                {{ number_format($relatedProduct->price, 0, ',', ' ') }} Ft
                                            </span>
                                        @else
                                            <span class="fw-bold">
                                                {{ number_format($relatedProduct->price, 0, ',', ' ') }} Ft
                                            </span>
                                        @endif
                                    </div>
                                    <div class="product-rating">
                                        <i class="fas fa-star text-warning"></i>
                                        <span class="small">4.8</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mennyiség input kezelése
        const quantityInput = document.getElementById('quantity');
        const quantityBtns = document.querySelectorAll('.quantity-btn');
        
        quantityBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.dataset.action;
                const currentValue = parseInt(quantityInput.value);
                const maxValue = parseInt(quantityInput.getAttribute('max'));
                
                if (action === 'increase' && currentValue < maxValue) {
                    quantityInput.value = currentValue + 1;
                } else if (action === 'decrease' && currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });
        });
        
        // Kosárhoz adás kezelése
        const addToCartBtn = document.querySelector('.add-to-cart-btn');
        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', function() {
                const productId = this.dataset.productId;
                const quantity = parseInt(document.getElementById('quantity').value);
                
                // Animáció hozzáadása a gombhoz
                const originalContent = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Folyamatban...';
                this.disabled = true;
                
                fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Kosár ikon frissítése
                        const cartCountElement = document.querySelector('.cart-count');
                        if (cartCountElement) {
                            cartCountElement.textContent = data.cartCount;
                        }
                        
                        // Értesítés megjelenítése
                        const toast = document.createElement('div');
                        toast.className = 'toast-notification success';
                        toast.innerHTML = `
                            <div class="toast-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="toast-message">Termék sikeresen hozzáadva a kosárhoz!</div>
                        `;
                        document.body.appendChild(toast);
                        
                        // Eltüntetés 3 másodperc után
                        setTimeout(() => {
                            toast.classList.add('fade-out');
                            setTimeout(() => toast.remove(), 300);
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Hiba történt:', error);
                    
                    // Hibaüzenet megjelenítése
                    const toast = document.createElement('div');
                    toast.className = 'toast-notification error';
                    toast.innerHTML = `
                        <div class="toast-icon"><i class="fas fa-exclamation-circle"></i></div>
                        <div class="toast-message">Hiba történt a kosárhoz adás során.</div>
                    `;
                    document.body.appendChild(toast);
                    
                    // Eltüntetés 3 másodperc után
                    setTimeout(() => {
                        toast.classList.add('fade-out');
                        setTimeout(() => toast.remove(), 300);
                    }, 3000);
                })
                .finally(() => {
                    // Gomb visszaállítása
                    this.innerHTML = originalContent;
                    this.disabled = false;
                });
            });
        }
        
        // Galéria kezelés - thumbnail képek
        const thumbnails = document.querySelectorAll('.thumbnail-container');
        const mainImage = document.getElementById('main-product-image');
        
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                // Aktív állapot átállítása
                thumbnails.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                // Főkép frissítése
                mainImage.src = this.dataset.src;
                
                // Animáció hozzáadása a képváltáshoz
                mainImage.style.opacity = '0.7';
                setTimeout(() => {
                    mainImage.style.opacity = '1';
                }, 200);
            });
        });
        
        // Link másolás a megosztáshoz
        const copyLinkBtn = document.querySelector('.copy-link-btn');
        if (copyLinkBtn) {
            copyLinkBtn.addEventListener('click', function() {
                const url = this.dataset.url;
                navigator.clipboard.writeText(url).then(() => {
                    // Értesítés megjelenítése
                    const toast = document.createElement('div');
                    toast.className = 'toast-notification success';
                    toast.innerHTML = `
                        <div class="toast-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="toast-message">Link másolva a vágólapra!</div>
                    `;
                    document.body.appendChild(toast);
                    
                    // Eltüntetés 3 másodperc után
                    setTimeout(() => {
                        toast.classList.add('fade-out');
                        setTimeout(() => toast.remove(), 300);
                    }, 3000);
                });
            });
        }
        
        // Kapcsolódó termékek kosárhoz adás kezelése
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                
                // Animáció hozzáadása a gombhoz
                const originalContent = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                this.disabled = true;
                
                fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Kosár ikon frissítése
                        const cartCountElement = document.querySelector('.cart-count');
                        if (cartCountElement) {
                            cartCountElement.textContent = data.cartCount;
                        }
                        
                        // Értesítés megjelenítése
                        const toast = document.createElement('div');
                        toast.className = 'toast-notification success';
                        toast.innerHTML = `
                            <div class="toast-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="toast-message">Termék sikeresen hozzáadva a kosárhoz!</div>
                        `;
                        document.body.appendChild(toast);
                        
                        // Eltüntetés 3 másodperc után
                        setTimeout(() => {
                            toast.classList.add('fade-out');
                            setTimeout(() => toast.remove(), 300);
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Hiba történt:', error);
                    
                    // Hibaüzenet megjelenítése
                    const toast = document.createElement('div');
                    toast.className = 'toast-notification error';
                    toast.innerHTML = `
                        <div class="toast-icon"><i class="fas fa-exclamation-circle"></i></div>
                        <div class="toast-message">Hiba történt a kosárhoz adás során.</div>
                    `;
                    document.body.appendChild(toast);
                    
                    // Eltüntetés 3 másodperc után
                    setTimeout(() => {
                        toast.classList.add('fade-out');
                        setTimeout(() => toast.remove(), 300);
                    }, 3000);
                })
                .finally(() => {
                    // Gomb visszaállítása
                    this.innerHTML = originalContent;
                    this.disabled = false;
                });
            });
        });
    });
</script>
@endpush

@push('styles')
<style>
    /* Termék részletes nézet stílusok */
    .main-image-container {
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .main-image-container img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: opacity 0.3s ease;
    }
    
    .thumbnail-gallery {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        padding-bottom: 10px;
    }
    
    .thumbnail-container {
        height: 80px;
        border: 2px solid transparent;
        border-radius: 0.5rem;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .thumbnail-container.active {
        border-color: var(--bs-primary);
    }
    
    .thumbnail-image {
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
    
    /* Tabs stílusok */
    .nav-tabs .nav-link {
        color: #495057;
        font-weight: 500;
    }
    
    .nav-tabs .nav-link.active {
        color: var(--bs-primary);
        font-weight: 700;
    }
    
    /* Termék kártya stílusok */
    .product-card {
        transition: all 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    
    .product-img-wrapper {
        height: 200px;
        overflow: hidden;
    }
    
    .product-img-wrapper img {
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .product-card:hover .product-img-wrapper img {
        transform: scale(1.05);
    }
    
    .product-actions {
        position: absolute;
        bottom: -40px;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 10px;
        padding: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        transition: bottom 0.3s ease;
    }
    
    .product-card:hover .product-actions {
        bottom: 0;
    }
    
    /* Toast értesítés stílusok */
    .toast-notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 15px 20px;
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        z-index: 9999;
        animation: slide-in 0.3s ease;
    }
    
    .toast-notification.success {
        border-left: 4px solid #28a745;
    }
    
    .toast-notification.error {
        border-left: 4px solid #dc3545;
    }
    .toast-notification.success .toast-icon {
        color: #28a745;
    }
    
    .toast-notification.error .toast-icon {
        color: #dc3545;
    }
    
    .toast-notification.fade-out {
        animation: slide-out 0.3s ease forwards;
    }
    
    @keyframes slide-in {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slide-out {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    /* Reszponzív igazítások */
    @media (max-width: 768px) {
        .main-image-container {
            height: 300px;
        }
        
        .product-share-buttons {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .social-icons {
            margin-top: 10px;
        }
    }
    
    /* Értékelés csillagok */
    .rating-stars .fas {
        cursor: pointer;
    }
    
    /* Áttűnés a tab váltáskor */
    .tab-pane {
        transition: all 0.3s ease;
    }
    
    /* Mennyiség input stílusok */
    .quantity-btn {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #495057;
    }
    
    .quantity-btn:hover {
        background-color: #e9ecef;
    }
    
    #quantity {
        width: 50px;
    }
    
    /* Árkedvezmény badge */
    .badge.bg-danger {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }
</style>
@endpush
@endsection