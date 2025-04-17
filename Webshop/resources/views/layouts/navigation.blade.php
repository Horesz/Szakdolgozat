<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        {{-- Logo és brand név --}}
        <a class="navbar-brand d-flex align-items-center" href="/">
            <i class="fas fa-gamepad me-2"></i>
            <span class="fw-bold">GamerShop</span>
        </a>

        {{-- Reszponzív hamburger menü --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar linkek --}}
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                        <i class="fas fa-home me-1"></i> Főoldal
                    </a>
                </li>
                {{-- Termék kategóriák dropdown --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-list me-1"></i> Kategóriák
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                        @foreach(\App\Models\Category::where('status', 'active')->get() as $category)
                            <li><a class="dropdown-item" href="/category/{{ $category->slug }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('deals') ? 'active' : '' }}" href="/deals">
                        <i class="fas fa-percentage me-1"></i> Akciók
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.browse') ? 'active' : '' }}" href="{{ route('products.browse') }}">
                        <i class="fas fa-box-open me-1"></i> Termékek böngészése
                    </a>
                </li>
            </ul>

            {{-- Keresés --}}
            <div class="d-flex align-items-center">
                <form class="d-flex me-3 search-form" action="/search" method="GET">
                    <div class="input-group">
                        <input class="form-control rounded-start" type="search" name="q" placeholder="Keresés..." aria-label="Search">
                        <button class="btn btn-primary rounded-end" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                {{-- Jobb oldali menü (nem bejelentkezett felhasználónak) --}}
                <ul class="navbar-nav d-flex flex-row">
                    <li class="nav-item me-3">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kosár">
                            <i class="fas fa-shopping-cart fs-5"></i>
                            @if(session()->has('cart_count') && session('cart_count') > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count">
                                    {{ session('cart_count') }}
                                </span>
                            @endif
                        </a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-primary btn-sm px-3 me-2" href="/login">
                                <i class="fas fa-sign-in-alt me-1"></i> Bejelentkezés
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary btn-sm px-3" href="/register">
                                <i class="fas fa-user-plus me-1"></i> Regisztráció
                            </a>
                        </li>
                    @else
                        {{-- A bejelentkezett felhasználó dropdown menüje megmarad --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-1"></i> {{ Auth::user()->firstname }}
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                @if(Auth::user()->role == 'admin') 
                                    {{-- Admin menü - Termékek szekció --}}
                                    <li><span class="dropdown-header">Termékek</span></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">
                                        <i class="fas fa-box fa-fw me-1"></i> Termékek kezelése
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.products.create') }}">
                                        <i class="fas fa-plus-circle fa-fw me-1"></i> Új termék hozzáadása
                                    </a></li>
                                    
                                    {{-- Admin menü - Kategóriák szekció --}}
                                    <li><hr class="dropdown-divider"></li>
                                    <li><span class="dropdown-header">Kategóriák</span></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">
                                        <i class="fas fa-folder fa-fw me-1"></i> Kategóriák kezelése
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.categories.create') }}">
                                        <i class="fas fa-folder-plus fa-fw me-1"></i> Új kategória hozzáadása
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                
                                @if(Auth::user()->role == 'munkatars') 
                                    <a href="/munkatars/oldal1" class="dropdown-item">Munkatárs oldal 1</a>
                                    <a href="/munkatars/oldal2" class="dropdown-item">Munkatárs oldal 2</a>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-user-circle fa-fw me-1"></i> Profil
                                </a></li>
                                <li><a class="dropdown-item" href="/orders">
                                    <i class="fas fa-shopping-bag fa-fw me-1"></i> Rendeléseim
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt fa-fw me-1"></i> Kijelentkezés
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
/* Egyedi CSS a modernebb megjelenéshez */
.navbar {
    padding: 0.8rem 1rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    background: linear-gradient(to right, #1a1a2e, #16213e) !important;
}

.navbar-brand {
    font-size: 1.5rem;
    letter-spacing: 0.5px;
}

.nav-link {
    padding: 0.5rem 1rem;
    font-weight: 500;
    position: relative;
    transition: all 0.3s ease;
}

.nav-link.active {
    color: #fff !important;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
}

.nav-link:not(.btn):hover {
    color: #fff !important;
    background-color: rgba(255, 255, 255, 0.05);
    border-radius: 4px;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    overflow: hidden;
    padding: 0.5rem 0;
}

.dropdown-item {
    padding: 0.6rem 1.5rem;
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
    padding-left: 1.7rem;
}

.dropdown-header {
    font-weight: bold;
    color: #6c757d;
    padding: 0.7rem 1.5rem 0.5rem;
}

.form-control {
    height: 38px;
    border: none;
}

.btn-primary {
    background-color: #3f51b5;
    border-color: #3f51b5;
}

.btn-primary:hover {
    background-color: #303f9f;
    border-color: #303f9f;
}

.btn-outline-primary {
    color: #3f51b5;
    border-color: #3f51b5;
}

.btn-outline-primary:hover {
    background-color: #3f51b5;
    color: white;
}

/* Animáció a bejelentkezési gomboknál */
.nav-link.btn {
    transition: all 0.3s ease;
    border-radius: 20px;
    margin-top: 0;
    margin-bottom: 0;
}

.nav-link.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Kosár ikon */
.cart-count {
    font-size: 0.6rem;
    transform: translate(-50%, -50%) !important;
}

@media (max-width: 991.98px) {
    .navbar-nav {
        margin-top: 1rem;
    }
    
    .d-flex.align-items-center {
        flex-direction: column;
        width: 100%;
    }
    
    .search-form {
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .navbar-nav.d-flex.flex-row {
        width: 100%;
        justify-content: space-between;
    }
    
    .nav-item .btn {
        display: block;
        width: 100%;
        text-align: center;
        margin-bottom: 0.5rem;
    }
}
</style>

{{-- Bootstrap Tooltip inicializálás --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>