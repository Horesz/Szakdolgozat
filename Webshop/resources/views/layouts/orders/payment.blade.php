@extends('layouts.app')

@section('title', 'Fizetés - GamerShop')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-0 fw-bold">Fizetés</h1>
                        <div>
                            <span class="badge bg-warning text-dark py-2 px-3">{{ $order->payment_status_text }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-info mb-4">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-info-circle fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="alert-heading">Fizetési információ</h5>
                                <p class="mb-0">Kérjük, adja meg kártyaadatait a fizetés véglegesítéséhez. A fizetés biztonságos, adatait nem tároljuk.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <p class="mb-1 text-muted">Rendelésszám</p>
                            <p class="mb-0 fw-bold">{{ $order->order_number }}</p>
                        </div>
                        <div class="text-end">
                            <p class="mb-1 text-muted">Fizetendő összeg</p>
                            <p class="mb-0 fw-bold fs-4">{{ number_format($order->total, 0, ',', ' ') }} Ft</p>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Fizetési űrlap (szimulált) -->
                    <form action="{{ route('orders.process-payment', $order->id) }}" method="POST" id="payment-form">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="card_holder" class="form-label">Kártyabirtokos neve <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="card_holder" name="card_holder" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="card_number" class="form-label">Kártyaszám <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="card_number" name="card_number" placeholder="XXXX XXXX XXXX XXXX" required>
                                <span class="input-group-text">
                                    <i class="fab fa-cc-visa me-2"></i>
                                    <i class="fab fa-cc-mastercard"></i>
                                </span>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="expiry_date" class="form-label">Lejárati dátum <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="HH/ÉÉ" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cvv" class="form-label">Biztonsági kód (CVV) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="XXX" required>
                            </div>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-lock me-2"></i>Biztonságos fizetés
                            </button>
                        </div>
                        
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                A fizetés gombra kattintva elfogadom a <a href="{{ route('terms') }}" target="_blank">fizetési feltételeket</a>.
                            </small>
                        </div>
                    </form>

                    <hr class="my-4">
                    
                    <div class="text-center">
                        <div class="mb-3">
                            <span class="text-muted small">Biztonságos fizetés a következő szolgáltatókon keresztül:</span>
                        </div>
                        <div class="payment-providers">
                            <i class="fab fa-cc-visa me-3 fa-2x text-secondary"></i>
                            <i class="fab fa-cc-mastercard me-3 fa-2x text-secondary"></i>
                            <i class="fab fa-cc-amex me-3 fa-2x text-secondary"></i>
                            <i class="fab fa-cc-paypal fa-2x text-secondary"></i>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-link">
                                <i class="fas fa-arrow-left me-2"></i>Vissza a rendeléshez
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Biztonsági információk -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    <div class="d-flex gap-3 align-items-center">
                        <div>
                            <i class="fas fa-shield-alt fa-2x text-success"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Biztonságos fizetés</h5>
                            <p class="mb-0 text-muted">A fizetési tranzakciók biztonságos és titkosított kapcsolaton keresztül történnek. A kártyaadatokat nem tároljuk.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Kártyaszám formázása
        const cardNumberInput = document.getElementById('card_number');
        cardNumberInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            let formattedValue = '';
            
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formattedValue += ' ';
                }
                formattedValue += value[i];
            }
            
            e.target.value = formattedValue.substring(0, 19);
        });
        
        // Lejárati dátum formázása
        const expiryDateInput = document.getElementById('expiry_date');
        expiryDateInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value.length > 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            
            e.target.value = value;
        });
        
        // CVV limitálása 3-4 számjegyre
        const cvvInput = document.getElementById('cvv');
        cvvInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value.substring(0, 4);
        });
        
        // Form validálás
        const paymentForm = document.getElementById('payment-form');
        paymentForm.addEventListener('submit', function(e) {
            const cardNumber = cardNumberInput.value.replace(/\s/g, '');
            const expiry = expiryDateInput.value;
            const cvv = cvvInput.value;
            
            // Egyszerű validáció (szimulált környezetben működik)
            if (cardNumber.length < 16) {
                e.preventDefault();
                alert('Kérjük, adjon meg egy érvényes kártyaszámot!');
                cardNumberInput.focus();
                return false;
            }
            
            if (expiry.length < 5) {
                e.preventDefault();
                alert('Kérjük, adjon meg egy érvényes lejárati dátumot (HH/ÉÉ formátumban)!');
                expiryDateInput.focus();
                return false;
            }
            
            if (cvv.length < 3) {
                e.preventDefault();
                alert('Kérjük, adjon meg egy érvényes biztonsági kódot!');
                cvvInput.focus();
                return false;
            }
            
            // Szimuláljuk a fizetés feldolgozását
            if (e.submitter.type === 'submit') {
                e.preventDefault();
                
                // Gomb deaktiválása és szöveg módosítása
                const submitButton = e.submitter;
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Feldolgozás...';
                
                // Szimuláljuk a feldolgozást egy késleltetéssel
                setTimeout(function() {
                    paymentForm.submit();
                }, 2000);
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
    /* Fizetési oldal stílusok */
    .card-header .badge {
        font-size: 0.9rem;
        font-weight: 500;
        padding: 0.5rem 1rem;
    }
    
    .payment-providers i {
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }
    
    .payment-providers i:hover {
        opacity: 1;
    }
    
    /* Input mezők */
    .form-control:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
    }
</style>
@endpush
@endsection