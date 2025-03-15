@extends('layouts.app')

@section('title', 'GamerShop - Főoldal')
@section('content')
    {{-- Hero Section --}}
    <div class="hero-section position-relative bg-dark text-white">
        <div class="container">
            <div class="row min-vh-75 align-items-center py-5">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4 text-gradient">Üdvözöllek a GamerShop-ban!</h1>
                    <p class="lead mb-4">Fedezd fel prémium gaming termékeinket és alakítsd ki a tökéletes setup-ot!</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('category.gaming-pc') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-gamepad me-2"></i>Fedezd fel kínálatunkat
                        </a>
                        <a href="{{ route('deals') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-percentage me-2"></i>Aktuális akciók
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="position-relative">
                        <img src="{{ asset('images/Gamershop.png') }}" alt="Gaming Setup" class="img-fluid rounded shadow-lg">
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-glow"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- Kategóriák Section --}}
{{-- Kategóriák Section (Frissített) --}}
<section class="py-5 bg-light category-section">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h6 class="text-primary text-uppercase fw-bold">Böngéssz kategóriák szerint</h6>
            <h2 class="display-6 fw-bold">Népszerű kategóriák</h2>
            <div class="separator mx-auto my-3"></div>
        </div>
        <div class="row g-4">
            @if(isset($categories) && count($categories) > 0)
                @foreach($categories as $category)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm category-card">
                            <div class="card-img-wrapper">
                                @php
                                    // Kategória képének meghatározása
                                    $imagePath = '';
                                    
                                    // 1. Ha van image mező a kategóriában
                                    if ($category->image) {
                                        $imagePath = $category->image;
                                    } 
                                    // 2. Ha van image_path mező (régi logika)
                                    elseif (isset($category->image_path)) {
                                        $imagePath = $category->image_path;
                                    } 
                                    // 3. Alapértelmezett kép
                                    else {
                                        $imagePath = 'images/categories/default.png';
                                    }
                                @endphp
                                
                                <img src="{{ asset($imagePath) }}" class="card-img-top" alt="{{ $category->name }}">
                                
                                <div class="card-overlay">
                                    <a href="/category/{{ $category->slug }}" class="btn btn-primary">Megnézem</a>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">{{ $category->name }}</h5>
                                @if($category->description)
                                    <p class="card-text small text-muted">{{ Str::limit($category->description, 60) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <div class="p-5 bg-white rounded shadow-sm">
                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                        <h4>Jelenleg nincs elérhető kategória</h4>
                        <p class="text-muted">Nézz vissza később új kategóriákért!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
{-- Új termékek szekció --}}
<section class="py-5 bg-gradient-dark text-white new-arrivals-section">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h6 class="text-warning text-uppercase fw-bold">Újdonságok</h6>
            <h2 class="display-6 fw-bold">Legújabb termékeink</h2>
            <div class="separator bg-warning mx-auto my-3"></div>
        </div>
        
        <div class="position-relative">
            <!-- Nyilak a csúsztatáshoz -->
            <button class="carousel-control-prev" type="button" id="newArrivalsControlPrev">
                <i class="fas fa-chevron-left fa-2x"></i>
            </button>
            <button class="carousel-control-next" type="button" id="newArrivalsControlNext">
                <i class="fas fa-chevron-right fa-2x"></i>
            </button>
            
            <!-- Termék csúszka -->
            <div class="row g-4 new-arrivals-slider">
                @foreach($newArrivals as $product)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-lg bg-dark text-white product-card">
                            <div class="position-relative product-img-wrapper">
                                <div class="new-badge position-absolute top-0 start-0 m-2 badge bg-warning text-dark">
                                    <i class="fas fa-bolt me-1"></i>ÚJ
                                </div>
                                
                                @if($product->images()->exists())
                                    <img src="{{ asset($product->images()->where('is_primary', 1)->first()->image_path) }}" 
                                         class="card-img-top" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top" alt="No Image">
                                @endif
                                
                                <div class="product-actions">
                                    <button class="btn btn-outline-light btn-sm quick-view-btn" 
                                            data-product-id="{{ $product->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm add-to-cart" 
                                            data-product-id="{{ $product->id }}">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold product-name">{{ $product->name }}</h5>
                                <p class="card-text text-light small product-desc">{{ Str::limit($product->short_description, 60) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="product-price">
                                        @if($product->original_price > $product->price)
                                            <span class="text-muted text-decoration-line-through small">
                                                {{ number_format($product->original_price, 0, ',', ' ') }} Ft
                                            </span>
                                            <span class="ms-2 text-warning fw-bold">
                                                {{ number_format($product->price, 0, ',', ' ') }} Ft
                                            </span>
                                        @else
                                            <span class="fw-bold text-white">
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
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('products') }}" class="btn btn-outline-warning btn-lg">
                <i class="fas fa-arrow-right me-2"></i>Összes új termék
            </a>
        </div>
    </div>
</section>
    
    {{-- Kiemelt termékek --}}
    <section class="py-5 featured-products">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h6 class="text-primary text-uppercase fw-bold">Válogatott termékek</h6>
                <h2 class="display-6 fw-bold">Kiemelt termékeink</h2>
                <div class="separator mx-auto my-3"></div>
            </div>
            <div class="row g-4">
                @foreach($featuredProducts as $product)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm product-card">
                            <div class="position-relative product-img-wrapper">
                                @if($product->images()->exists())
                                    <img src="{{ asset($product->images()->where('is_primary', 1)->first()->image_path) }}" 
                                         class="card-img-top" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('images/no-image.jpg') }}" 
                                         class="card-img-top" alt="No Image">
                                @endif
                                @if($product->discount)
                                    <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 m-2 rounded-pill">
                                        <i class="fas fa-fire-alt me-1"></i>-{{ $product->discount }}%
                                    </div>
                                @endif
                                <div class="product-actions">
                                    <button class="btn btn-outline-light btn-sm quick-view-btn" 
                                            data-product-id="{{ $product->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm add-to-cart" 
                                            data-product-id="{{ $product->id }}">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold product-name">{{ $product->name }}</h5>
                                <p class="card-text text-muted small product-desc">{{ Str::limit($product->description, 80) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="product-price">
                                        @if($product->discount)
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
            <div class="text-center mt-5">
                <a href="{{ route('products') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-th-list me-2"></i>Összes termék megtekintése
                </a>
            </div>
        </div>
    </section>

    {{-- Miért minket válassz? --}}
    <section class="py-5 bg-dark text-white features-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h6 class="text-primary text-uppercase fw-bold">Előnyök</h6>
                <h2 class="display-6 fw-bold">Miért válassz minket?</h2>
                <div class="separator mx-auto my-3 bg-light"></div>
            </div>
            <div class="row g-4">
                <div class="col-md-3 text-center feature-card">
                    <div class="feature-icon bg-primary text-white mx-auto mb-4">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h4 class="fw-bold">Gyors kiszállítás</h4>
                    <p class="text-light">Rendelésedet 1-2 munkanapon belül kiszállítjuk egész országon belül</p>
                </div>
                <div class="col-md-3 text-center feature-card">
                    <div class="feature-icon bg-primary text-white mx-auto mb-4">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="fw-bold">Garancia</h4>
                    <p class="text-light">Minden termékünkre 2 év teljes körű garanciát vállalunk</p>
                </div>
                <div class="col-md-3 text-center feature-card">
                    <div class="feature-icon bg-primary text-white mx-auto mb-4">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4 class="fw-bold">24/7 Support</h4>
                    <p class="text-light">Ügyfélszolgálatunk a hét minden napján rendelkezésedre áll</p>
                </div>
                <div class="col-md-3 text-center feature-card">
                    <div class="feature-icon bg-primary text-white mx-auto mb-4">
                        <i class="fas fa-undo"></i>
                    </div>
                    <h4 class="fw-bold">14 napos visszavétel</h4>
                    <p class="text-light">Nem tetszik a termék? 14 napon belül visszaküldheted indoklás nélkül</p>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Hírlevél feliratkozás --}}
    <section class="py-5 bg-light newsletter-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="newsletter-card bg-white p-5 rounded-3 shadow text-center">
                        <div class="section-header mb-4">
                            <span class="badge bg-primary mb-2">MARADJ NAPRAKÉSZ</span>
                            <h2 class="fw-bold">Iratkozz fel hírlevelünkre!</h2>
                            <p class="text-muted">Értesülj elsőként az akciókról és az új termékekről!</p>
                        </div>
                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="row g-3 justify-content-center">
                            @csrf
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="far fa-envelope text-primary"></i>
                                    </span>
                                    <input type="email" class="form-control form-control-lg border-start-0" 
                                           name="email" placeholder="E-mail címed" required>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Feliratkozás
                                </button>
                            </div>
                        </form>
                        <div class="form-text mt-3">
                            <i class="fas fa-lock me-1 text-muted"></i>
                            Nem küldünk spam-et, bármikor leiratkozhatsz.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- JavaScript a kosárhoz --}}
    @push('scripts')
    <script>
        // Termék kosárhoz adása
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                
                // Animáció hozzáadása a gombhoz
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
                        document.querySelector('.cart-count').textContent = data.cartCount;
                        
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
                        
                        // Gomb visszaállítása
                        this.innerHTML = '<i class="fas fa-cart-plus"></i>';
                        this.disabled = false;
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
                    
                    // Gomb visszaállítása
                    this.innerHTML = '<i class="fas fa-cart-plus"></i>';
                    this.disabled = false;
                });
            });
        });
        
        // Gyors megtekintés gomb kezelése
        document.querySelectorAll('.quick-view-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                // Itt lehetne implementálni a gyors megtekintés modált
                console.log(`Gyors megtekintés: ${productId}`);
            });
        });
        
        // Kategória kártyák hover effekt
        document.querySelectorAll('.category-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.querySelector('.card-overlay').classList.add('active');
            });
            card.addEventListener('mouseleave', function() {
                this.querySelector('.card-overlay').classList.remove('active');
            });
        });
    </script>
    @endpush
    
    {{-- CSS a frissített designhoz --}}
    @push('styles')
<style>
    /* Általános stílusok */
    body {
        font-family: 'Poppins', sans-serif;
    }
    
    .separator {
        width: 50px;
        height: 3px;
        background-color: var(--bs-primary);
    }
    
    .text-gradient {
        background: linear-gradient(90deg, #2b5be0 0%, #5834b4 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    /* Hero szekció */
    .hero-section {
        background: linear-gradient(135deg, #13151f 0%, #232741 100%);
        position: relative;
        overflow: hidden;
    }
    
    .bg-glow {
        background: radial-gradient(circle at center, rgba(77, 100, 234, 0.3) 0%, rgba(0, 0, 0, 0) 70%);
        pointer-events: none;
    }
    
    /* Kategória kártyák */
    .category-card {
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    
    .card-img-wrapper {
        position: relative;
        overflow: hidden;
    }
    
    .card-img-top {
        transition: transform 0.5s ease;
        height: 180px;
        object-fit: cover;
    }
    
    .category-card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .card-overlay.active, .category-card:hover .card-overlay {
        opacity: 1;
    }
    
    /* Termék kártyák */
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
    
    .product-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .product-desc {
        height: 40px;
        overflow: hidden;
    }
    
    /* Előnyök szekció */
    .feature-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        transition: transform 0.3s ease;
    }
    
    .feature-card:hover .feature-icon {
        transform: scale(1.1);
    }
    
    /* Hírlevél szekció */
    .newsletter-card {
        border-top: 5px solid var(--bs-primary);
    }
    
    /* Új termékek szekció stílusai */
    .bg-gradient-dark {
        background: linear-gradient(135deg, #1a1a2e 0%, #30305a 100%);
    }
    
    .new-arrivals-section {
        position: relative;
        padding: 80px 0;
    }
    
    .new-arrivals-section .carousel-control-prev,
    .new-arrivals-section .carousel-control-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        border: none;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .new-arrivals-section .carousel-control-prev {
        left: -25px;
    }
    
    .new-arrivals-section .carousel-control-next {
        right: -25px;
    }
    
    .new-arrivals-section .carousel-control-prev:hover,
    .new-arrivals-section .carousel-control-next:hover {
        background-color: rgba(255, 255, 255, 0.3);
    }
    
    .new-badge {
        z-index: 2;
        font-size: 0.8rem;
    }

    /* Termék kártyák sötét stílusa */
    .bg-dark .product-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }
    
    .bg-dark .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3) !important;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    /* Statisztika számláló stílusok */
    .stats-counter-section {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    }
    
    .counter-icon {
        height: 80px;
        width: 80px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    
    .counter-item:hover .counter-icon {
        transform: scale(1.1);
        background-color: rgba(255, 255, 255, 0.2);
    }
    
    .counter-number {
        font-size: 2.5rem;
        font-weight: 700;
    }
    
    /* Értesítések */
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
    
    /* Reszponzív igazítások */
    @media (max-width: 992px) {
        .new-arrivals-section .carousel-control-prev,
        .new-arrivals-section .carousel-control-next {
            display: none;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Kategória kártyák hover effekt
    document.addEventListener('DOMContentLoaded', function() {
        // Termék kosárhoz adása
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                
                // Animáció hozzáadása a gombhoz
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
                        document.querySelector('.cart-count').textContent = data.cartCount;
                        
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
                        
                        // Gomb visszaállítása
                        this.innerHTML = '<i class="fas fa-cart-plus"></i>';
                        this.disabled = false;
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
                    
                    // Gomb visszaállítása
                    this.innerHTML = '<i class="fas fa-cart-plus"></i>';
                    this.disabled = false;
                });
            });
        });
        
        // Gyors megtekintés gomb kezelése
        document.querySelectorAll('.quick-view-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                // Itt lehetne implementálni a gyors megtekintés modált
                console.log(`Gyors megtekintés: ${productId}`);
            });
        });
        
        // Kategória kártyák hover effekt
        document.querySelectorAll('.category-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.querySelector('.card-overlay').classList.add('active');
            });
            card.addEventListener('mouseleave', function() {
                this.querySelector('.card-overlay').classList.remove('active');
            });
        });
        
        // Új termékek slider kezelése
        const prevButton = document.getElementById('newArrivalsControlPrev');
        const nextButton = document.getElementById('newArrivalsControlNext');
        const slider = document.querySelector('.new-arrivals-slider');
        
        if (prevButton && nextButton && slider) {
            // Egyszerűsített scroll balra/jobbra, ha vannak gombok
            prevButton.addEventListener('click', function() {
                slider.scrollBy({ left: -300, behavior: 'smooth' });
            });
            
            nextButton.addEventListener('click', function() {
                slider.scrollBy({ left: 300, behavior: 'smooth' });
            });
        }
        
        // Számláló animáció
        const counters = document.querySelectorAll('.counter-number');
        const speed = 200; // Minél nagyobb, annál lassabb a számolás
        
        // Ellenőrizzük, hogy láthatóak-e a számlálók
        const isElementInViewport = (el) => {
            const rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        };
        
        // Számláló funkció
        const startCounting = () => {
            counters.forEach(counter => {
                if (isElementInViewport(counter) && !counter.classList.contains('counted')) {
                    counter.classList.add('counted');
                    
                    const target = +counter.getAttribute('data-target');
                    const increment = target / speed;
                    
                    const updateCount = () => {
                        const count = +counter.innerText;
                        if (count < target) {
                            counter.innerText = Math.ceil(count + increment);
                            setTimeout(updateCount, 1);
                        } else {
                            counter.innerText = target.toLocaleString();
                        }
                    };
                    
                    updateCount();
                }
            });
        };
        
        // Indítás scroll eseményre és betöltéskor
        window.addEventListener('scroll', startCounting);
        startCounting(); // Betöltéskor is ellenőrizzük
    });
</script>
@endpush
@endsection