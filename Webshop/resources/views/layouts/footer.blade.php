{{-- Egyszerűsített footer.blade.php - GamerShop --}}

<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row mb-4">
            <!-- Logo és közösségi média -->
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-gamepad me-2"></i>
                    <h5 class="mb-0">GamerShop</h5>
                </div>
                <div class="mt-3 social-icons">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-discord"></i></a>
                </div>
            </div>

            <!-- Információk -->
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5 class="mb-3">INFORMÁCIÓK</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('about') }}" class="footer-link">Rólunk</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('products.browse') }}" class="footer-link">Termékek</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('deals') }}" class="footer-link">Akciók</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('terms') }}" class="footer-link">ÁSZF</a>
                    </li>
                    <li>
                        <a href="{{ route('privacy') }}" class="footer-link">Adatvédelem</a>
                    </li>
                </ul>
            </div>

            <!-- Kapcsolat -->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="mb-3">KAPCSOLAT</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-map-marker-alt me-2"></i> 1234 Budapest, Játék utca 123.
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-phone me-2"></i> +36 1 234 5678
                    </li>
                    <li>
                        <i class="fas fa-envelope me-2"></i> info@gamershop.hu
                    </li>
                </ul>
            </div>

            <!-- Hírlevél -->
            <div class="col-lg-3 col-md-6">
                <h5 class="mb-3">Iratkozz fel hírlevelünkre</h5>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="mb-2">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Email címed" required>
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                    <small class="text-white">
                        Feliratkozással elfogadod <a href="{{ route('privacy') }}" class="text-primary">adatvédelmi irányelveinket</a>.
                    </small>
                </form>
            </div>
        </div>

        <hr class="my-4 bg-secondary">

        <!-- Fizetési módok és szállítás -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <h6 class="mb-3">Fizetési módok</h6>
                <div class="payment-icons">
                    <span class="me-2"><i class="fab fa-cc-visa"></i></span>
                    <span class="me-2"><i class="fab fa-cc-mastercard"></i></span>
                    <span class="me-2"><i class="fab fa-paypal"></i></span>
                    <span class="me-2"><i class="fas fa-money-bill-wave"></i></span>
                    <span><i class="fas fa-university"></i></span>
                </div>
            </div>
            <div class="col-md-6">
                <h6 class="mb-3">Szállítási partnerek</h6>
                <div class="shipping-icons">
                    <span class="me-3"><i class="fas fa-truck"></i></span>
                    <span class="me-3"><i class="fas fa-box"></i></span>
                    <span class="me-3"><i class="fas fa-shipping-fast"></i></span>
                    <span><i class="fas fa-store-alt"></i></span>
                </div>
            </div>
        </div>

        <hr class="my-4 bg-secondary">

        <!-- Copyright sor -->
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="small mb-0">
                    &copy; {{ date('Y') }} GamerShop - Minden jog fenntartva
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="small mb-0">
                    Készítette: <a href="https://github.com/horesz" class="text-white text-decoration-underline">Sinka Barnabás</a>
                </p>
            </div>
        </div>
    </div>
</footer>

@push('styles')
<style>
    /* Egyszerűsített footer stílusok */
    .footer-link {
        color: #a9a9a9;
        text-decoration: none;
        transition: color 0.2s;
    }
    
    .footer-link:hover {
        color: #ffffff;
    }
    
    .social-icons a {
        font-size: 18px;
        transition: opacity 0.2s;
    }
    
    .social-icons a:hover {
        opacity: 0.8;
    }
    
    .payment-icons span, .shipping-icons span {
        font-size: 1.5rem;
        color: #a9a9a9;
    }
    
    hr.bg-secondary {
        opacity: 0.1;
    }
    
    /* Input mező és gomb */
    .input-group .form-control {
        border: none;
        background-color: #2c2c2c;
        color: #fff;
    }
    
    .input-group .form-control::placeholder {
        color: #a9a9a9;
    }
    
    .input-group .btn {
        background-color: #6366f1;
        border-color: #6366f1;
    }
    
    /* Gombok */
    .btn-primary {
        background-color: #6366f1;
        border-color: #6366f1;
    }
    
    .btn-primary:hover {
        background-color: #5152d9;
        border-color: #5152d9;
    }
</style>
@endpush