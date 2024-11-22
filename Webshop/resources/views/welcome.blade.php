@extends('layouts.app')

@section('title', 'GamerShop - Főoldal')
@section('content')
    {{-- Hero Section --}}
    <div class="hero-section position-relative">
        <div class="container">
            <div class="row min-vh-75 align-items-center py-5">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Üdvözöllek a GamerShop-ban!</h1>
                    <p class="lead mb-4">Fedezd fel prémium gaming termékeinket és alakítsd ki a tökéletes setup-ot!</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('category.gaming-pc') }}" class="btn btn-primary btn-lg">
                            Fedezd fel kínálatunkat
                        </a>
                        <a href="{{ route('deals') }}" class="btn btn-outline-dark btn-lg">
                            Aktuális akciók
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('images/Gamershop.png') }}" alt="Gaming Setup" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Népszerű kategóriák</h2>
            <div class="row g-4">
                <!-- Gamerpc kártya -->

                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/categories/gamerpcCategoryimage.png') }}" class="card-img-top" alt="Gaming PC">
                        <div class="card-body text-center">
                            <h5 class="card-title">Gaming PC-k</h5>
                            <a href="{{ route('category.gaming-pc') }}" class="btn btn-outline-primary">Megnézem</a>
                        </div>
                    </div>
                </div>
                <!-- perifériák kártya -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/categories/peripherals.png') }}" class="card-img-top" alt="Perifériák">
                        <div class="card-body text-center">
                            <h5 class="card-title">Perifériák</h5>
                            <a href="{{ route('category.peripherals') }}" class="btn btn-outline-primary">Megnézem</a>
                        </div>
                    </div>
                </div>
                <!-- Alkatrészek kártya -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/categories/alkatreszek.png') }}" class="card-img-top" alt="Alkatrészek">
                        <div class="card-body text-center">
                            <h5 class="card-title">Alkatrészek</h5>
                            <a href="{{ route('category.components') }}" class="btn btn-outline-primary">Megnézem</a>
                        </div>
                    </div>
                </div>
                <!-- Kiegészítők kártya -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/categories/accessories.png') }}" class="card-img-top" alt="Kiegészítők">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kiegészítők</h5>
                            <a href="{{ route('category.accessories') }}" class="btn btn-outline-primary">Megnézem</a>
                        </div>
                    </div>
                </div>
                <!-- Játékok kártya -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/categories/games.png') }}" class="card-img-top" alt="Játékok">
                        <div class="card-body text-center">
                            <h5 class="card-title">Játékok</h5>
                            <a href="{{ route('category.games') }}" class="btn btn-outline-primary">Megnézem</a>
                        </div>
                    </div>
                </div>
                <!-- Konzolok kártya -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/categories/consoles.png') }}" class="card-img-top" alt="Konzolok">
                        <div class="card-body text-center">
                            <h5 class="card-title">Konzolok</h5>
                            <a href="{{ route('category.consoles') }}" class="btn btn-outline-primary">Megnézem</a>
                        </div>
                    </div>
                </div>
                <!-- Laptop kártya -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/categories/laptop.png') }}" class="card-img-top" alt="Konzolok">
                        <div class="card-body text-center">
                            <h5 class="card-title">Laptop</h5>
                            <a href="{{ route('category.consoles') }}" class="btn btn-outline-primary">Megnézem</a>
                        </div>
                    </div>
                </div>
                <!-- Telefon kártya -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/categories/telefon.png') }}" class="card-img-top" alt="Konzolok">
                        <div class="card-body text-center">
                            <h5 class="card-title">Telefon</h5>
                            <a href="{{ route('category.consoles') }}" class="btn btn-outline-primary">Megnézem</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    {{-- Kiemelt termékek --}}
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Kiemelt termékeink</h2>
            <div class="row g-4">
                @foreach($featuredProducts as $product)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="position-relative">
                                <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                @if($product->discount)
                                    <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 m-2 rounded">
                                        -{{ $product->discount }}%
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        @if($product->discount)
                                            <span class="text-muted text-decoration-line-through">
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
                                    <button class="btn btn-primary add-to-cart" 
                                            data-product-id="{{ $product->id }}">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Miért minket válassz? --}}
    <section class="py-5 bg-dark text-white">
        <div class="container">
            <h2 class="text-center mb-5">Miért válassz minket?</h2>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <i class="fas fa-shipping-fast fa-3x mb-3"></i>
                    <h4>Gyors kiszállítás</h4>
                    <p>Rendelésedet 1-2 munkanapon belül kiszállítjuk</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-shield-alt fa-3x mb-3"></i>
                    <h4>Garancia</h4>
                    <p>Minden termékünkre 2 év teljes körű garanciát vállalunk</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-headset fa-3x mb-3"></i>
                    <h4>24/7 Support</h4>
                    <p>Ügyfélszolgálatunk a hét minden napján rendelkezésedre áll</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Hírlevél feliratkozás --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6">
                    <h2 class="mb-4">Iratkozz fel hírlevelünkre!</h2>
                    <p class="text-muted mb-4">Értesülj elsőként az akciókról és az új termékekről!</p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="row g-3 justify-content-center">
                        @csrf
                        <div class="col-8">
                            <input type="email" class="form-control form-control-lg" 
                                   name="email" placeholder="E-mail címed" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-lg">Feliratkozás</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- JavaScript a kosárhoz --}}
    @push('scripts')
    <script>
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
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
                        // Sikeres üzenet megjelenítése
                        alert('Termék sikeresen hozzáadva a kosárhoz!');
                    }
                })
                .catch(error => {
                    console.error('Hiba történt:', error);
                    alert('Hiba történt a kosárhoz adás során.');
                });
            });
        });
    </script>
    @endpush
@endsection