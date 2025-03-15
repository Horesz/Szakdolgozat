<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        {{-- Logo és brand név --}}
        <a class="navbar-brand d-flex align-items-center" href="/">
            <i class="fas fa-gamepad me-2"></i>
            GamerShop
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
                        <i class="fas fa-box-open me-1"></i>Termékek böngészése
                    </a>
                </li>
            </ul>

            {{-- Keresés --}}
            <form class="d-flex me-3" action="/search" method="GET">
                <div class="input-group">
                    <input class="form-control" type="search" name="q" placeholder="Keresés..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            {{-- Jobb oldali menü --}}
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart"></i>
                        @if(session()->has('cart_count') && session('cart_count') > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count">
                                {{ session('cart_count') }}
                            </span>
                        @endif
                    </a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            <i class="fas fa-sign-in-alt me-1"></i> Bejelentkezés
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">
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
</nav>