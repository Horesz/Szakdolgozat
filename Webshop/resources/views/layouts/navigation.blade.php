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
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.browse') && !request()->has('category') ? 'active' : '' }}" href="{{ route('products.browse') }}">
                        <i class="fas fa-box-open me-1"></i> Termékek böngészése
                    </a>
                </li>
                {{-- Termék kategóriák dropdown --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('products.browse') && request()->has('category') ? 'active' : '' }}" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-list me-1"></i> Kategóriák
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                        @foreach(\App\Models\Category::where('status', 'active')->get() as $category)
                            <li><a class="dropdown-item {{ request()->input('category') == $category->id ? 'active' : '' }}" href="{{ route('products.browse', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                        @endforeach
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('categories.index') }}"><i class="fas fa-th-large me-1"></i> Összes kategória</a></li>
                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->is('deals') ? 'active' : '' }}" href="/deals">
                        <i class="fas fa-percentage me-1"></i> Akciók
                    </a>
                </li> --}}
                
                {{-- Új menüpontok --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="shopInfoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-info-circle me-1"></i> Információk
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="shopInfoDropdown">
                        <li><a class="dropdown-item" href="/about"><i class="fas fa-store me-1"></i> Rólunk</a></li>
                        <li><a class="dropdown-item" href="/contact"><i class="fas fa-envelope me-1"></i> Kapcsolat</a></li>
                        <li><a class="dropdown-item" href="/shipping"><i class="fas fa-truck me-1"></i> Szállítási információk</a></li>
                        <li><a class="dropdown-item" href="/payment"><i class="fas fa-credit-card me-1"></i> Fizetési módok</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/faq"><i class="fas fa-question-circle me-1"></i> GYIK</a></li>
                    </ul>
                </li>
            </ul>

            {{-- Keresés --}}
            <div class="d-flex align-items-center">
                <form class="d-flex me-3 search-form" action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <input class="form-control rounded-start" type="search" name="q" placeholder="Keresés..." aria-label="Search" required>
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-1"></i> {{ Auth::user()->firstname }}
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                @if(Auth::user()->role == 'admin') 
                                    {{-- Admin menü - Rendelések szekció --}}
                                    <li><hr class="dropdown-divider"></li>
                                    <li><span class="dropdown-header">Rendelések</span></li>
                                    
                                    @if(request()->routeIs('admin.orders.*'))
                                        <li>
                                            <span class="dropdown-item active">
                                                <i class="fas fa-shopping-cart fa-fw me-1"></i> Rendelések kezelése
                                            </span>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.orders.index') }}">
                                                <i class="fas fa-shopping-cart fa-fw me-1"></i> Rendelések kezelése
                                            </a>
                                        </li>
                                    @endif
                                    
                                    {{-- Termékek szekció --}}
                                    <li><hr class="dropdown-divider"></li>
                                    <li><span class="dropdown-header">Termékek</span></li>
                                    
                                    @if(request()->routeIs('admin.products.index'))
                                        <li>
                                            <span class="dropdown-item active">
                                                <i class="fas fa-box fa-fw me-1"></i> Termékek kezelése
                                            </span>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.products.index') }}">
                                                <i class="fas fa-box fa-fw me-1"></i> Termékek kezelése
                                            </a>
                                        </li>
                                    @endif
                                    
                                    @if(request()->routeIs('admin.products.create'))
                                        <li>
                                            <span class="dropdown-item active">
                                                <i class="fas fa-plus-circle fa-fw me-1"></i> Új termék hozzáadása
                                            </span>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.products.create') }}">
                                                <i class="fas fa-plus-circle fa-fw me-1"></i> Új termék hozzáadása
                                            </a>
                                        </li>
                                    @endif
                                    
                                    {{-- Kategóriák szekció --}}
                                    <li><hr class="dropdown-divider"></li>
                                    <li><span class="dropdown-header">Kategóriák</span></li>
                                    
                                    @if(request()->routeIs('admin.categories.index'))
                                        <li>
                                            <span class="dropdown-item active">
                                                <i class="fas fa-folder fa-fw me-1"></i> Kategóriák kezelése
                                            </span>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.categories.index') }}">
                                                <i class="fas fa-folder fa-fw me-1"></i> Kategóriák kezelése
                                            </a>
                                        </li>
                                    @endif
                                    
                                    @if(request()->routeIs('admin.categories.create'))
                                        <li>
                                            <span class="dropdown-item active">
                                                <i class="fas fa-folder-plus fa-fw me-1"></i> Új kategória hozzáadása
                                            </span>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.categories.create') }}">
                                                <i class="fas fa-folder-plus fa-fw me-1"></i> Új kategória hozzáadása
                                            </a>
                                        </li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                
                                @if(Auth::user()->role == 'munkatars') 
                                    <li><span class="dropdown-header">Munkatársi feladatok</span></li>
                                    
                                    @if(request()->routeIs('admin.orders.*'))
                                        <li>
                                            <span class="dropdown-item active">
                                                <i class="fas fa-shopping-cart fa-fw me-1"></i> Rendelések kezelése
                                            </span>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.orders.index') }}">
                                                <i class="fas fa-shopping-cart fa-fw me-1"></i> Rendelések kezelése
                                            </a>
                                        </li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                
                                @if(request()->routeIs('dashboard'))
                                    <li>
                                        <span class="dropdown-item active">
                                            <i class="fas fa-user-circle fa-fw me-1"></i> Profil
                                        </span>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            <i class="fas fa-user-circle fa-fw me-1"></i> Profil
                                        </a>
                                    </li>
                                @endif
                                
                                @if(request()->routeIs('orders.index'))
                                    <li>
                                        <span class="dropdown-item active">
                                            <i class="fas fa-shopping-bag fa-fw me-1"></i> Rendeléseim
                                        </span>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item" href="/orders">
                                            <i class="fas fa-shopping-bag fa-fw me-1"></i> Rendeléseim
                                        </a>
                                    </li>
                                @endif
                                
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
/* Aktív menüpont stílusa */
.dropdown-item.active {
    background-color: #f8f9fa;
    color: #212529;
    font-weight: bold;
    cursor: default;
}

/* Aktív szülő menüpont stílusa */
.nav-link.active {
    position: relative;
}

.nav-link.active:after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 30%;
    right: 30%;
    height: 3px;
    background-color: #fff;
    border-radius: 3px;
}
</style>

{{-- Bootstrap Tooltip inicializálás --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Bootstrap tooltips inicializálása
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>