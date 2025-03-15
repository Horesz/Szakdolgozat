@extends('layouts.app')

@section('title', 'Termékek böngészése - GamerShop')

@section('content')
<div class="bg-light py-5">
    <div class="container">
        <div class="row">
            <!-- Oldalsáv szűrőkkel -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Szűrés</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.browse') }}" method="GET" id="filterForm">
                            <!-- Keresés -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Keresés</label>
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Keresési kifejezés..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Kategória szűrő -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Kategória</label>
                                <select name="category" class="form-select" onchange="this.form.submit()">
                                    <option value="">Minden kategória</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Ár szűrő -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Ár (Ft)</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" name="min_price" class="form-control" placeholder="Min" value="{{ request('min_price') }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="max_price" class="form-control" placeholder="Max" value="{{ request('max_price') }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-outline-primary mt-2 w-100">Alkalmaz</button>
                            </div>
                            
                            <!-- Rendezés -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Rendezés</label>
                                <select name="sort" class="form-select" onchange="this.form.submit()">
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Legújabb elöl</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Ár szerint növekvő</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Ár szerint csökkenő</option>
                                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Név szerint (A-Z)</option>
                                </select>
                            </div>
                            
                            <!-- Szűrők törlése -->
                            <div class="d-grid">
                                <a href="{{ route('products.browse') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-sync-alt me-2"></i>Szűrők törlése
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Akciós banner -->
                <div class="card border-0 shadow-sm bg-gradient-primary text-white mb-4">
                    <div class="card-body text-center p-4">
                        <div class="py-3">
                            <i class="fas fa-percentage fa-3x mb-3"></i>
                            <h5 class="fw-bold">Aktuális kedvezmények</h5>
                            <p>Akár 50% kedvezmény a kiemelt termékekre!</p>
                            <a href="{{ route('deals') }}" class="btn btn-outline-light">Akciós termékek</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Termék lista -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">Termékek böngészése</h1>
                        <p class="text-muted mb-0">{{ $products->total() }} találat</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-secondary view-mode" data-mode="grid" title="Rács nézet">
                            <i class="fas fa-th"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary view-mode" data-mode="list" title="Lista nézet">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
                
                @if($products->isEmpty())
                    <div class="alert alert-info text-center p-5">
                        <i class="fas fa-search fa-3x mb-3"></i>
                        <h4>Nincs találat a keresési feltételekre</h4>
                        <p>Próbáld meg más keresési feltételekkel vagy töröld a szűrőket.</p>
                        <a href="{{ route('products.browse') }}" class="btn btn-primary">
                            <i class="fas fa-sync-alt me-2"></i>Összes termék mutatása
                        </a>
                    </div>
                @else
                    <div class="row g-4 products-grid">
                        @foreach($products as $product)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm product-card">
                                    <div class="position-relative product-img-wrapper">
                                        @if($product->images()->exists())
                                            <img src="{{ asset($product->images()->where('is_primary', 1)->first()->image_path) }}" 
                                                 class="card-img-top" alt="{{ $product->name }}">
                                        @else
                                            <img src="{{ asset('images/no-image.jpg') }}" 
                                                 class="card-img-top" alt="No Image">
                                        @endif
                                        
                                        @if($product->original_price > $product->price)
                                            <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 m-2 rounded-pill">
                                                <i class="fas fa-fire-alt me-1"></i>-{{ round((1 - $product->price / $product->original_price) * 100) }}%
                                            </div>
                                        @endif
                                        
                                        <div class="product-actions">
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-light btn-sm bg-primary">
                                                <i class="fas  fa-eye"></i>
                                            </a>
                                            <button class="btn btn-primary btn-sm add-to-cart" 
                                                    data-product-id="{{ $product->id }}">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold product-name">{{ $product->name }}</h5>
                                        <p class="card-text text-muted small product-desc">{{ Str::limit($product->short_description, 80) }}</p>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div class="product-price">
                                                @if($product->original_price > $product->price)
                                                    <span class="text-muted text-decoration-line-through small">
                                                        {{ number_format($product->original_price, 0, ',', ' ') }} Ft
                                                    </span>
                                                    <span class="ms-2 text-danger fw-bold">
                                                        {{ number_format($product->price, 0, ',', ' ') }} Ft
                                                    </span>
                                                @else
                                                    <span class="fw-bold">
                                                        {{ number_format($product->price, 0, ',', ' ') }} Ft
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
                    
                    <!-- Lista nézet -->
                    <div class="products-list d-none">
                        @foreach($products as $product)
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <div class="position-relative h-100">
                                            @if($product->images()->exists())
                                                <img src="{{ asset($product->images()->where('is_primary', 1)->first()->image_path) }}" 
                                                     class="img-fluid h-100 w-100 object-fit-cover" alt="{{ $product->name }}">
                                            @else
                                                <img src="{{ asset('images/no-image.jpg') }}" 
                                                     class="img-fluid h-100 w-100 object-fit-cover" alt="No Image">
                                            @endif
                                            
                                            @if($product->original_price > $product->price)
                                                <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 m-2 rounded-pill">
                                                    <i class="fas fa-fire-alt me-1"></i>-{{ round((1 - $product->price / $product->original_price) * 100) }}%
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h5 class="card-title fw-bold mb-2">{{ $product->name }}</h5>
                                                <div class="product-price">
                                                    @if($product->original_price > $product->price)
                                                        <span class="text-muted text-decoration-line-through small">
                                                            {{ number_format($product->original_price, 0, ',', ' ') }} Ft
                                                        </span>
                                                        <span class="ms-2 text-danger fw-bold">
                                                            {{ number_format($product->price, 0, ',', ' ') }} Ft
                                                        </span>
                                                    @else
                                                        <span class="fw-bold">
                                                            {{ number_format($product->price, 0, ',', ' ') }} Ft
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="card-text text-muted">{{ Str::limit($product->short_description, 150) }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="product-meta">
                                                    <span class="badge bg-secondary me-2">{{ $product->category->name }}</span>
                                                    <span class="badge bg-light text-dark me-2">
                                                        <i class="fas fa-star text-warning me-1"></i>4.8
                                                    </span>
                                                    @if($product->stock_quantity > 0)
                                                        <span class="badge bg-success">Készleten</span>
                                                    @else
                                                        <span class="badge bg-danger">Elfogyott</span>
                                                    @endif
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary text-white bg-primary">
                                                        <i class="fas fa-eye text-white me-1"></i>Részletek
                                                    </a>
                                                    <button class="btn btn-primary add-to-cart" data-product-id="{{ $product->id }}">
                                                        <i class="fas fa-cart-plus me-1"></i>Kosárba
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Lapozás -->
                    <div class="d-flex flex-column align-items-center mt-5">
                        @if ($products->hasPages())
                            <nav aria-label="Termékek lapozása">
                                <ul class="pagination">
                                    {{-- Előző gomb --}}
                                    @if ($products->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-hidden="true"></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev" aria-label="Előző"></a>
                                        </li>
                                    @endif

                                    {{-- Oldalszámok --}}
                                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    {{-- Következő gomb --}}
                                    @if ($products->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next" aria-label="Következő"></a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-hidden="true"></span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                            <div class="pagination-info mt-2">
                                {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} / {{ $products->total() }} termék
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Nézet váltás (grid/list)
        const viewModeButtons = document.querySelectorAll('.view-mode');
        const productsGrid = document.querySelector('.products-grid');
        const productsList = document.querySelector('.products-list');
        
        // Mentett nézet betöltése
        const savedViewMode = localStorage.getItem('productViewMode') || 'grid';
        setViewMode(savedViewMode);
        
        viewModeButtons.forEach(button => {
            // Aktív állapot beállítása betöltéskor
            if (button.dataset.mode === savedViewMode) {
                button.classList.add('active', 'btn-primary');
                button.classList.remove('btn-outline-secondary');
            }
            
            button.addEventListener('click', function() {
                const mode = this.dataset.mode;
                setViewMode(mode);
                
                // Mentés localStorage-ba
                localStorage.setItem('productViewMode', mode);
                
                // Gombok aktív állapotának kezelése
                viewModeButtons.forEach(btn => {
                    btn.classList.remove('active', 'btn-primary');
                    btn.classList.add('btn-outline-secondary');
                });
                
                this.classList.add('active', 'btn-primary');
                this.classList.remove('btn-outline-secondary');
            });
        });
        
        function setViewMode(mode) {
            if (mode === 'grid') {
                productsGrid.classList.remove('d-none');
                productsList.classList.add('d-none');
            } else {
                productsGrid.classList.add('d-none');
                productsList.classList.remove('d-none');
            }
        }
        
        // Kosárhoz adás kezelése
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
    /* Termék lista nézet stílusok */
    .object-fit-cover {
        object-fit: cover;
    }
    
    /* Szűrőkre és termék kártyákra vonatkozó stílusok */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    
    /* Modern lapozás stílusok */
    .pagination {
        display: inline-flex;
        padding: 0;
        margin: 0;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .page-item:first-child .page-link {
        border-top-left-radius: 0.5rem;
        border-bottom-left-radius: 0.5rem;
    }

    .page-item:last-child .page-link {
        border-top-right-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
    }

    .page-item.active .page-link {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
        font-weight: 600;
        color: white;
        box-shadow: 0 0 10px rgba(var(--bs-primary-rgb), 0.5);
        z-index: 3;
    }

    .page-item.disabled .page-link {
        color: #c2c7d0;
        background-color: #f8f9fa;
        border-color: #e9ecef;
    }

    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 40px;
        min-width: 40px;
        padding: 0 15px;
        line-height: 40px;
        text-align: center;
        border: 1px solid #e4e6ef;
        color: #5e6278;
        background-color: #ffffff;
        font-weight: 500;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
    }

    .page-link:hover {
        background-color: #f8f9fa;
        color: var(--bs-primary);
        border-color: #e4e6ef;
        z-index: 2;
    }

    /* Modern nyilak */
    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        font-size: 0;
        position: relative;
        width: 50px;
    }

    .pagination .page-item:first-child .page-link:before,
    .pagination .page-item:last-child .page-link:before {
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        font-size: 16px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .pagination .page-item:first-child .page-link:before {
        content: "\f104"; /* fa-angle-left */
    }

    .pagination .page-item:last-child .page-link:before {
        content: "\f105"; /* fa-angle-right */
    }

    /* Nem letiltott nyilak hover effekt */
    .pagination .page-item:not(.disabled):first-child .page-link:hover,
    .pagination .page-item:not(.disabled):last-child .page-link:hover {
        background: var(--bs-primary);
        color: white;
        border-color: var(--bs-primary);
    }

    /* Aktuális szám és összes szám jelzése */
    .pagination-info {
        color: #6c757d;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        text-align: center;
    }
    
    /* Ár csúszka stílusok */
    .form-range::-webkit-slider-thumb {
        background: var(--bs-primary);
    }
    
    .form-range::-moz-range-thumb {
        background: var(--bs-primary);
    }
    
    /* Aktív gomb */
    .view-mode.active {
        background-color: var(--bs-primary);
        color: white;
        border-color: var(--bs-primary);
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
    
    .toast-icon {
        margin-right: 15px;
        font-size: 20px;
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
</style>
@endpush
@endsection