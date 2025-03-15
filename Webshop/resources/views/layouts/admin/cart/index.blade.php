@extends('layouts.app')

@section('title', 'Kosár - GamerShop')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-3 fw-bold">Kosár tartalma</h1>
            
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
            
            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    
    @if(count($cartItems) > 0)
        <div class="row">
            <!-- Kosár tartalom -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Termékek ({{ array_sum(array_column($cartItems, 'quantity')) }} db)</h5>
                            <a href="{{ route('cart.clear') }}" class="btn btn-sm btn-outline-danger" 
                               onclick="return confirm('Biztosan kiüríted a kosarat?')">
                                <i class="fas fa-trash-alt me-1"></i>Kosár ürítése
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead class="text-muted small bg-light">
                                    <tr>
                                        <th scope="col" class="py-3 ps-4">Termék</th>
                                        <th scope="col" class="py-3 text-center">Ár</th>
                                        <th scope="col" class="py-3 text-center">Mennyiség</th>
                                        <th scope="col" class="py-3 text-center">Összesen</th>
                                        <th scope="col" class="py-3 pe-4 text-center">Műveletek</th>
                                    </tr>
                                </thead>
                                <tbody class="border-top">
                                    @foreach($cartItems as $id => $item)
                                        <tr data-id="{{ $id }}" class="cart-item">
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" 
                                                         class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;" />
                                                    <div class="ms-3">
                                                        <h6 class="fw-bold mb-0">
                                                            <a href="{{ route('products.show', $id) }}" class="text-dark text-decoration-none">
                                                                {{ $item['name'] }}
                                                            </a>
                                                        </h6>
                                                        @if(isset($item['product']) && $item['product']->category)
                                                            <span class="text-muted small">{{ $item['product']->category->name }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($item['price'], 0, ',', ' ') }} Ft
                                            </td>
                                            <td class="text-center" style="width: 150px;">
                                                <div class="input-group input-group-sm quantity-control">
                                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="decrease">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="number" class="form-control text-center item-quantity" value="{{ $item['quantity'] }}" 
                                                           min="1" max="{{ $item['product']->stock_quantity ?? 99 }}" />
                                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="increase">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="text-center fw-bold item-subtotal">
                                                {{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} Ft
                                            </td>
                                            <td class="text-center pe-4">
                                                <button class="btn btn-sm btn-outline-danger remove-from-cart" title="Eltávolítás">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Vásárlás folytatása -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('products.browse') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Vásárlás folytatása
                    </a>
                    <button id="update-cart-btn" class="btn btn-primary d-none">
                        <i class="fas fa-sync-alt me-2"></i>Kosár frissítése
                    </button>
                </div>
            </div>
            
            <!-- Összesítés -->
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Összesítés</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Részösszeg:</span>
                            <span class="fw-bold" id="cart-subtotal">{{ number_format($subtotal, 0, ',', ' ') }} Ft</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Szállítási költség:</span>
                            <span class="fw-bold" id="shipping-cost">
                                @if($shippingCost > 0)
                                    {{ number_format($shippingCost, 0, ',', ' ') }} Ft
                                @else
                                    <span class="badge bg-success">Ingyenes</span>
                                @endif
                            </span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Végösszeg:</span>
                            <span class="fw-bold fs-5" id="cart-total">{{ number_format($total, 0, ',', ' ') }} Ft</span>
                        </div>
                        
                        <!-- Kupon kód -->
                        <div class="mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Kuponkód" aria-label="Kuponkód">
                                <button class="btn btn-outline-secondary" type="button">Beváltás</button>
                            </div>
                            <div class="form-text">Ha van kuponkódod, itt válthatod be.</div>
                        </div>
                        
                        <!-- Fizetés gomb -->
                        <div class="d-grid">
                            <a href="{{ route('cart.checkout') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-credit-card me-2"></i>Tovább a fizetéshez
                            </a>
                        </div>
                        
                        <!-- Elfogadott fizetési módok -->
                        <div class="mt-4 text-center">
                            <p class="text-muted small mb-2">Elfogadott fizetési módok</p>
                            <div class="payment-methods">
                                <i class="fab fa-cc-visa fs-4 mx-1 text-secondary"></i>
                                <i class="fab fa-cc-mastercard fs-4 mx-1 text-secondary"></i>
                                <i class="fab fa-cc-paypal fs-4 mx-1 text-secondary"></i>
                                <i class="fas fa-money-bill-wave fs-4 mx-1 text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Segítség -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">
                        <h6 class="mb-3"><i class="fas fa-question-circle me-2 text-primary"></i>Segítségre van szükséged?</h6>
                        <p class="small mb-0">Hívj minket a <a href="tel:+36123456789" class="text-decoration-none">+36 12 345 6789</a> telefonszámon vagy <a href="{{ route('contact') }}" class="text-decoration-none">írj nekünk</a>!</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Üres kosár -->
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card border-0 shadow-sm p-5 text-center">
                    <div class="py-5">
                        <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
                        <h3>A kosarad üres</h3>
                        <p class="text-muted mb-4">Fedezd fel kínálatunkat és adj hozzá termékeket a kosaradhoz!</p>
                        <a href="{{ route('products.browse') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-store me-2"></i>Vásárlás most
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Ajánlott termékek -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4">Neked ajánljuk</h3>
        </div>
        
        <!-- Itt lehet egy lista az ajánlott termékekről -->
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // CSRF token beállítása az AJAX kérésekhez
        const csrfToken = "{{ csrf_token() }}";
        
        // Mennyiség gombok kezelése
        const quantityBtns = document.querySelectorAll('.quantity-btn');
        quantityBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.dataset.action;
                const input = this.parentElement.querySelector('.item-quantity');
                const currentValue = parseInt(input.value);
                const maxValue = parseInt(input.getAttribute('max'));
                
                if (action === 'increase' && currentValue < maxValue) {
                    input.value = currentValue + 1;
                    updateCartItem(input);
                } else if (action === 'decrease' && currentValue > 1) {
                    input.value = currentValue - 1;
                    updateCartItem(input);
                }
            });
        });
        
        // Mennyiség input változásának figyelése
        const quantityInputs = document.querySelectorAll('.item-quantity');
        quantityInputs.forEach(input => {
            input.addEventListener('change', function() {
                updateCartItem(this);
            });
        });
        
        // Kosárból eltávolítás
        const removeButtons = document.querySelectorAll('.remove-from-cart');
        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const id = row.dataset.id;
                
                if (confirm('Biztosan eltávolítod ezt a terméket a kosárból?')) {
                    removeCartItem(id, row);
                }
            });
        });
        
        // Kosár elem frissítése
        function updateCartItem(input) {
            const row = input.closest('tr');
            const id = row.dataset.id;
            const quantity = parseInt(input.value);
            
            // Animáció mutatása
            row.classList.add('updating');
            
            fetch('{{ route('cart.update') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Frissítsük a megjelenített részösszeget
                    row.querySelector('.item-subtotal').textContent = data.itemSubtotal;
                    
                    // Frissítsük a kosár számláló ikont
                    updateCartCounter(data.cartCount);
                    
                    // Értesítés megjelenítése
                    showNotification('success', 'Kosár sikeresen frissítve!');
                    
                    // Frissítsük az összesítőt (ez egy példa, a tényleges értékeket AJAX-szal kéne lekérni)
                    // Valós környezetben itt egy új AJAX kérést küldenénk a frissített összesítő adatokért
                } else {
                    showNotification('error', data.message || 'Hiba történt a frissítés során.');
                }
            })
            .catch(error => {
                console.error('Hiba történt:', error);
                showNotification('error', 'Hiba történt a frissítés során.');
            })
            .finally(() => {
                row.classList.remove('updating');
            });
        }
        
        // Kosár elem eltávolítása
        function removeCartItem(id, row) {
            // Animáció mutatása
            row.classList.add('removing');
            
            fetch('{{ route('cart.remove') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    id: id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Frissítsük a kosár számláló ikont
                    updateCartCounter(data.cartCount);
                    
                    // Távolítsuk el a sort animációval
                    row.style.height = row.offsetHeight + 'px';
                    setTimeout(() => {
                        row.style.height = '0';
                        row.style.opacity = '0';
                        row.style.margin = '0';
                        row.style.padding = '0';
                        
                        setTimeout(() => {
                            row.remove();
                            
                            // Ha ez volt az utolsó termék, frissítsük az oldalt
                            if (document.querySelectorAll('.cart-item').length === 0) {
                                window.location.reload();
                            }
                        }, 300);
                    }, 300);
                    
                    // Értesítés megjelenítése
                    showNotification('success', 'Termék sikeresen eltávolítva!');
                } else {
                    showNotification('error', data.message || 'Hiba történt az eltávolítás során.');
                    row.classList.remove('removing');
                }
            })
            .catch(error => {
                console.error('Hiba történt:', error);
                showNotification('error', 'Hiba történt az eltávolítás során.');
                row.classList.remove('removing');
            });
        }
        
        // Kosár számláló frissítése
        function updateCartCounter(count) {
            const cartCounter = document.querySelector('.cart-count');
            if (cartCounter) {
                if (count > 0) {
                    cartCounter.textContent = count;
                    cartCounter.classList.remove('d-none');
                } else {
                    cartCounter.classList.add('d-none');
                }
            }
        }
        
        // Értesítés megjelenítése
        function showNotification(type, message) {
            const toast = document.createElement('div');
            toast.className = `toast-notification ${type}`;
            toast.innerHTML = `
                <div class="toast-icon"><i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i></div>
                <div class="toast-message">${message}</div>
            `;
            document.body.appendChild(toast);
            
            // Eltüntetés 3 másodperc után
            setTimeout(() => {
                toast.classList.add('fade-out');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    });
</script>
@endpush

@push('styles')
<style>
    /* Kosár oldal stílusok */
    .cart-item {
        transition: all 0.3s ease;
    }
    
    .cart-item.updating {
        background-color: rgba(255, 251, 214, 0.2);
    }
    
    .cart-item.removing {
        background-color: rgba(255, 236, 236, 0.2);
        transition: all 0.3s ease;
    }
    
    .quantity-control {
        width: 120px;
        margin: 0 auto;
    }
    
    .item-quantity {
        text-align: center;
    }
    
    /* Értesítés stílusok */
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
    @media (max-width: 768px) {
        .table-responsive .table {
            min-width: 700px;
        }
    }
</style>
@endpush
@endsection