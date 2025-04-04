@extends('layouts.app')

@section('title', 'Pénztár - GamerShop')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-3 fw-bold">Pénztár</h1>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Hiba!</strong> Kérjük, ellenőrizd az űrlapot.
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    
    <form action="{{ route('orders.store') }}" method="POST" id="checkout-form">
        @csrf
        <div class="row">
            <!-- Szállítási és fizetési adatok -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Szállítási adatok</h5>
                    </div>
                    <div class="card-body">
                        <!-- Ha be van jelentkezve a felhasználó, előtöltjük az adatait -->
                        @auth
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="firstname" class="form-label">Keresztnév <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname', auth()->user()->firstname) }}" required>
                                    @error('firstname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastname" class="form-label">Vezetéknév <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname', auth()->user()->lastname) }}" required>
                                    @error('lastname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email cím <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Telefonszám <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-3 mb-3">
                                    <label for="address_zip" class="form-label">Irányítószám <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('address_zip') is-invalid @enderror" id="address_zip" name="address_zip" value="{{ old('address_zip', auth()->user()->address_zip) }}" required>
                                    @error('address_zip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="address_city" class="form-label">Város <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('address_city') is-invalid @enderror" id="address_city" name="address_city" value="{{ old('address_city', auth()->user()->address_city) }}" required>
                                    @error('address_city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="address_street" class="form-label">Utca, házszám <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('address_street') is-invalid @enderror" id="address_street" name="address_street" value="{{ old('address_street', auth()->user()->address_street) }}" required>
                                    @error('address_street')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="address_additional" class="form-label">Kiegészítő cím információk</label>
                                <input type="text" class="form-control @error('address_additional') is-invalid @enderror" id="address_additional" name="address_additional" value="{{ old('address_additional', auth()->user()->address_additional) }}" placeholder="Emelet, ajtó, egyéb információk">
                                @error('address_additional')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="save_address" id="save_address" value="1" checked>
                                <label class="form-check-label" for="save_address">
                                    Adataim mentése a következő vásárláshoz
                                </label>
                            </div>
                        @else
                            <div class="alert alert-info">
                                A megrendeléshez be kell jelentkezned vagy regisztrálnod kell.
                                <div class="mt-3">
                                    <a href="{{ route('login') }}" class="btn btn-primary me-2">Bejelentkezés</a>
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Regisztráció</a>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
                
                <!-- Szállítási mód -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Szállítási mód</h5>
                    </div>
                    <div class="card-body">
                        <div class="shipping-options">
                            <div class="form-check shipping-option mb-3">
                                <input class="form-check-input" type="radio" name="shipping_method" id="shipping_courier" value="courier" {{ old('shipping_method') == 'courier' ? 'checked' : 'checked' }}>
                                <label class="form-check-label d-flex justify-content-between align-items-center w-100 ms-2" for="shipping_courier">
                                    <div>
                                        <span class="fw-bold d-block">Házhozszállítás futárral</span>
                                        <span class="text-muted small">1-2 munkanapon belül</span>
                                    </div>
                                    <span class="fw-bold">1 490 Ft</span>
                                </label>
                            </div>
                            
                            <div class="form-check shipping-option mb-3">
                                <input class="form-check-input" type="radio" name="shipping_method" id="shipping_pickup_point" value="pickup_point" {{ old('shipping_method') == 'pickup_point' ? 'checked' : '' }}>
                                <label class="form-check-label d-flex justify-content-between align-items-center w-100 ms-2" for="shipping_pickup_point">
                                    <div>
                                        <span class="fw-bold d-block">Csomagpont</span>
                                        <span class="text-muted small">1-3 munkanapon belül</span>
                                    </div>
                                    <span class="fw-bold">990 Ft</span>
                                </label>
                            </div>
                            
                            <div class="form-check shipping-option mb-3">
                                <input class="form-check-input" type="radio" name="shipping_method" id="shipping_store" value="store" {{ old('shipping_method') == 'store' ? 'checked' : '' }}>
                                <label class="form-check-label d-flex justify-content-between align-items-center w-100 ms-2" for="shipping_store">
                                    <div>
                                        <span class="fw-bold d-block">Személyes átvétel üzletünkben</span>
                                        <span class="text-muted small">Nyitvatartási időben</span>
                                    </div>
                                    <span class="fw-bold text-success">Ingyenes</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Fizetési mód -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Fizetési mód</h5>
                    </div>
                    <div class="card-body">
                        <div class="payment-options">
                            <div class="form-check payment-option mb-3">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_card" value="card" {{ old('payment_method') == 'card' ? 'checked' : 'checked' }}>
                                <label class="form-check-label d-flex justify-content-between align-items-center w-100 ms-2" for="payment_card">
                                    <div>
                                        <span class="fw-bold d-block">Bankkártyával online</span>
                                        <span class="text-muted small">Biztonságos fizetés a SimplePay rendszerén keresztül</span>
                                    </div>
                                    <div class="payment-icons">
                                        <i class="fab fa-cc-visa me-1"></i>
                                        <i class="fab fa-cc-mastercard"></i>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="form-check payment-option mb-3">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_transfer" value="transfer" {{ old('payment_method') == 'transfer' ? 'checked' : '' }}>
                                <label class="form-check-label d-flex justify-content-between align-items-center w-100 ms-2" for="payment_transfer">
                                    <div>
                                        <span class="fw-bold d-block">Banki átutalás</span>
                                        <span class="text-muted small">Az utalási adatokat emailben küldjük el</span>
                                    </div>
                                    <i class="fas fa-university"></i>
                                </label>
                            </div>
                            
                            <div class="form-check payment-option mb-3">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_cod" value="cod" {{ old('payment_method') == 'cod' ? 'checked' : '' }}>
                                <label class="form-check-label d-flex justify-content-between align-items-center w-100 ms-2" for="payment_cod">
                                    <div>
                                        <span class="fw-bold d-block">Utánvét</span>
                                        <span class="text-muted small">Fizetés átvételkor készpénzben vagy kártyával</span>
                                    </div>
                                    <i class="fas fa-money-bill-wave"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Megjegyzés -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Megjegyzés a rendeléshez</h5>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" name="order_notes" id="order_notes" rows="3" placeholder="Opcionális megjegyzés a rendeléshez, szállításhoz...">{{ old('order_notes') }}</textarea>
                    </div>
                </div>
            </div>
            
            <!-- Rendelés összesítő -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4 sticky-top" style="top: 20px;">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Rendelésed összegzése</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="mb-3">Termékek ({{ array_sum(array_column($cartItems, 'quantity')) }} db)</h6>
                            <div class="order-items">
                                @foreach($cartItems as $id => $item)
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <span class="d-block">{{ $item['name'] }}</span>
                                            <span class="text-muted small">{{ $item['quantity'] }} x {{ number_format($item['price'], 0, ',', ' ') }} Ft</span>
                                        </div>
                                        <span class="fw-bold">{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} Ft</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Részösszeg:</span>
                                <span class="fw-bold" id="cart-subtotal">{{ number_format($subtotal, 0, ',', ' ') }} Ft</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 shipping-cost-row">
                                <span>Szállítási költség:</span>
                                <span class="fw-bold" id="shipping-cost">
                                    @if($shippingCost > 0)
                                        {{ number_format($shippingCost, 0, ',', ' ') }} Ft
                                    @else
                                        <span class="badge bg-success">Ingyenes</span>
                                    @endif
                                </span>
                            </div>
                            @if(isset($discount) && $discount > 0)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Kedvezmény:</span>
                                    <span class="fw-bold text-danger">-{{ number_format($discount, 0, ',', ' ') }} Ft</span>
                                </div>
                            @endif
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Végösszeg:</span>
                            <span class="fw-bold fs-5" id="cart-total">{{ number_format($total, 0, ',', ' ') }} Ft</span>
                        </div>
                        
                        <!-- Kupon kód -->
                        <div class="mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="coupon_code" placeholder="Kuponkód" value="{{ old('coupon_code') }}">
                                <button class="btn btn-outline-secondary" type="button" id="apply-coupon">Beváltás</button>
                            </div>
                            <div class="form-text">Ha van kuponkódod, itt válthatod be.</div>
                        </div>
                        
                        <!-- ÁSZF elfogadása -->
                        <div class="form-check mb-4">
                            <input class="form-check-input @error('terms_accepted') is-invalid @enderror" type="checkbox" id="terms_accepted" name="terms_accepted" value="1" required {{ old('terms_accepted') ? 'checked' : '' }}>
                            <label class="form-check-label" for="terms_accepted">
                                Elolvastam és elfogadom az <a href="{{ route('terms') }}" target="_blank">Általános Szerződési Feltételeket</a> és az <a href="{{ route('privacy') }}" target="_blank">Adatvédelmi szabályzatot</a>.
                            </label>
                            @error('terms_accepted')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Rendelés véglegesítése -->
                        @auth
                            <button type="submit" class="btn btn-primary btn-lg w-100" id="place-order-btn">
                                <i class="fas fa-check-circle me-2"></i>Rendelés véglegesítése
                            </button>
                        @else
                            <button type="button" class="btn btn-primary btn-lg w-100" disabled>
                                <i class="fas fa-check-circle me-2"></i>Rendelés véglegesítése
                            </button>
                            <div class="text-center mt-2 text-muted small">
                                Jelentkezz be a rendelés leadásához
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Szállítási módok kezelése
        const shippingOptions = document.querySelectorAll('input[name="shipping_method"]');
        const shippingCostDisplay = document.getElementById('shipping-cost');
        const cartTotal = document.getElementById('cart-total');
        
        // Szállítási költségek (Ft-ban)
        const shippingCosts = {
            'courier': 1490,
            'pickup_point': 990,
            'store': 0
        };
        
        // Kezdeti subtotal (kiszállítás nélkül)
        const subtotal = {{ $subtotal }};
        
        // Szállítási mód változásának figyelése
        shippingOptions.forEach(option => {
            option.addEventListener('change', updateTotals);
        });
        
        // Összegek frissítése a szállítási mód alapján
        function updateTotals() {
            const selectedShipping = document.querySelector('input[name="shipping_method"]:checked').value;
            const shippingCost = shippingCosts[selectedShipping];
            
            // Szállítási költség megjelenítése
            if (shippingCost > 0) {
                shippingCostDisplay.innerHTML = `${new Intl.NumberFormat('hu-HU').format(shippingCost)} Ft`;
            } else {
                shippingCostDisplay.innerHTML = `<span class="badge bg-success">Ingyenes</span>`;
            }
            
            // Végösszeg számítása és megjelenítése
            const total = subtotal + shippingCost;
            cartTotal.textContent = `${new Intl.NumberFormat('hu-HU').format(total)} Ft`;
        }
        
        // Kupon kezelés (egyszerűsített verzió)
        const couponInput = document.querySelector('input[name="coupon_code"]');
        const applyCouponBtn = document.getElementById('apply-coupon');
        
        applyCouponBtn.addEventListener('click', function() {
            const couponCode = couponInput.value.trim();
            if (couponCode) {
                alert('A kuponkód funkció jelenleg fejlesztés alatt áll.');
                // Itt lenne az AJAX kérés a kuponkód ellenőrzéséhez
            } else {
                alert('Kérjük, adj meg egy kuponkódot!');
            }
        });
        
        // Rendelés elküldésének ellenőrzése
        const checkoutForm = document.getElementById('checkout-form');
        const placeOrderBtn = document.getElementById('place-order-btn');
        
        if (checkoutForm && placeOrderBtn) {
            placeOrderBtn.addEventListener('click', function(e) {
                // Ellenőrizzük, hogy a kötelező mezők ki vannak-e töltve
                const requiredFields = checkoutForm.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value) {
                        isValid = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Kérjük, töltsd ki az összes kötelező mezőt!');
                    // Görgetés az első hibás mezőhöz
                    const firstInvalid = checkoutForm.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        }
    });
</script>
@endpush

@push('styles')
<style>
    /* Checkout oldal stílusok */
    .shipping-option, .payment-option {
        border: 1px solid #e5e5e5;
        border-radius: 6px;
        padding: 15px;
        margin-bottom: 15px;
        transition: all 0.2s ease;
    }
    
    .shipping-option:hover, .payment-option:hover {
        background-color: #f8f9fa;
    }
    
    .shipping-option input:checked + label, .payment-option input:checked + label {
        font-weight: 500;
    }
    
    .shipping-option input:checked + label::after, .payment-option input:checked + label::after {
        content: '✓';
        display: inline-block;
        margin-left: 0.5rem;
        color: var(--bs-success);
    }
    
    .shipping-option input:checked + label, .payment-option input:checked + label {
        color: var(--bs-primary);
    }
    
    .shipping-option input:checked + label .text-muted, .payment-option input:checked + label .text-muted {
        color: var(--bs-primary) !important;
        opacity: 0.8;
    }
    
    .shipping-option input:checked + label .fw-bold, .payment-option input:checked + label .fw-bold {
        color: var(--bs-primary);
    }
    
    .shipping-option, .payment-option {
        position: relative;
    }
    
    .shipping-option input[type="radio"], .payment-option input[type="radio"] {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 15px;
    }
    
    .payment-icons {
        font-size: 1.5rem;
        color: #6c757d;
    }
    
    /* Sticky összegző jobb oldalon */
    @media (min-width: 992px) {
        .sticky-top {
            position: sticky;
            top: 20px;
        }
    }
    
    /* Reszponzív igazítások */
    @media (max-width: 768px) {
        .shipping-option label, .payment-option label {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .shipping-option label > span:last-child, .payment-option label > div:last-child {
            margin-top: 10px;
        }
    }
</style>
@endpush
@endsection