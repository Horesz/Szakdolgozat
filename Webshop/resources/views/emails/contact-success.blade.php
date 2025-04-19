@extends('layouts.app')

@section('title', 'Köszönjük megkeresésed - GamerShop')

@section('content')
<div class="success-page py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-md-5 text-center">
                        <div class="mb-4">
                            <div class="success-icon mx-auto">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                        </div>
                        
                        <h1 class="display-5 fw-bold mb-4">Köszönjük megkeresésed!</h1>
                        <p class="lead mb-4">Üzeneted sikeresen elküldve. Kollégáink hamarosan felveszik veled a kapcsolatot a megadott e-mail címen.</p>
                        
                        <div class="alert alert-info p-4 mb-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle fa-2x text-primary"></i>
                                </div>
                                <div class="ms-3 text-start">
                                    <h5>Mit tehetsz most?</h5>
                                    <p class="mb-0">Ügyfélszolgálatunk igyekszik minden megkeresésre 24 órán belül válaszolni. Sürgős esetben hívd telefonos ügyfélszolgálatunkat!</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="card h-100 border-0 bg-light">
                                    <div class="card-body p-4">
                                        <i class="fas fa-phone-alt fa-2x text-primary mb-3"></i>
                                        <h5>Telefonos elérhetőség</h5>
                                        <p class="mb-0">+36 1 123 4567</p>
                                        <p class="small text-muted">H-P: 9:00-17:00</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card h-100 border-0 bg-light">
                                    <div class="card-body p-4">
                                        <i class="fas fa-store fa-2x text-primary mb-3"></i>
                                        <h5>Személyes ügyfélszolgálat</h5>
                                        <p class="mb-0">1134 Budapest, Gamer utca 42.</p>
                                        <p class="small text-muted">H-P: 10:00-18:00, Szo: 10:00-14:00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-home me-2"></i>Vissza a főoldalra
                            </a>
                            <a href="{{ route('products.browse') }}" class="btn btn-outline-primary btn-lg ms-2">
                                <i class="fas fa-shopping-bag me-2"></i>Termékek böngészése
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .success-icon {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: rgba(40, 167, 69, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        margin-bottom: 20px;
    }
    
    .success-page .card {
        border-radius: 15px;
    }
    
    .success-page .alert {
        border-radius: 12px;
    }
    
    .success-page .card-body {
        border-radius: 15px;
    }
</style>
@endpush