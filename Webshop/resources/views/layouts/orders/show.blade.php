@extends('layouts.app')

@section('title', 'Rendelés részletei - GamerShop')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1 fw-bold">Rendelés részletei</h1>
                    <p class="text-muted mb-0">Rendelésszám: {{ $order->order_number }}</p>
                </div>
                <div>
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Vissza a rendeléseimhez
                    </a>
                </div>
            </div>
            
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
            
            <!-- Rendelés állapota -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4">
                        <div>
                            <p class="mb-1 text-muted small">Rendelés ideje</p>
                            <p class="mb-0 fw-bold">{{ $order->created_at->format('Y.m.d. H:i') }}</p>
                        </div>
                        <div class="mt-3 mt-sm-0">
                            <div class="d-flex flex-column align-items-start align-items-sm-end">
                                <p class="mb-1 text-muted small">Rendelés állapota</p>
                                <div class="order-status">
                                    @switch($order->order_status)
                                        @case('pending')
                                            <span class="badge bg-info">{{ $order->status_text }}</span>
                                            @break
                                        @case('processing')
                                            <span class="badge bg-primary">{{ $order->status_text }}</span>
                                            @break
                                        @case('shipped')
                                            <span class="badge bg-warning text-dark">{{ $order->status_text }}</span>
                                            @break
                                        @case('delivered')
                                            <span class="badge bg-success">{{ $order->status_text }}</span>
                                            @break
                                        @case('completed')
                                            <span class="badge bg-success">{{ $order->status_text }}</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-danger">{{ $order->status_text }}</span>
                                            @break
                                        @case('refunded')
                                            <span class="badge bg-secondary">{{ $order->status_text }}</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">{{ $order->status_text }}</span>
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rendelés folyamat állapota -->
                    <div class="order-progress">
                        <div class="order-progress-track">
                            <div class="order-progress-line" style="width: {{ $order->progress_percentage }}%;"></div>
                        </div>
                        <div class="order-progress-steps">
                            <div class="order-progress-step
                                {{ in_array($order->order_status, ['pending', 'processing', 'shipped', 'delivered', 'completed']) ? 'completed' : 
                                   ($order->order_status == 'cancelled' ? 'cancelled' : '') }}">
                                <div class="order-progress-icon">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <div class="order-progress-title">Rendelés feldolgozása</div>
                            </div>
                            <div class="order-progress-step
                                {{ in_array($order->order_status, ['processing', 'shipped', 'delivered', 'completed']) ? 'completed' : 
                                   ($order->order_status == 'cancelled' ? 'cancelled' : '') }}">
                                <div class="order-progress-icon">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="order-progress-title">Előkészítés</div>
                            </div>
                            <div class="order-progress-step
                                {{ in_array($order->order_status, ['shipped', 'delivered', 'completed']) ? 'completed' : 
                                   ($order->order_status == 'cancelled' ? 'cancelled' : '') }}">
                                <div class="order-progress-icon">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <div class="order-progress-title">Szállítás alatt</div>
                            </div>
                            <div class="order-progress-step
                                {{ in_array($order->order_status, ['delivered', 'completed']) ? 'completed' : 
                                   ($order->order_status == 'cancelled' ? 'cancelled' : '') }}">
                                <div class="order-progress-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="order-progress-title">Kézbesítve</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rendelés műveletei -->
                    <div class="mt-4 d-flex justify-content-end">
                        @if($order->canBeCancelled())
                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="me-2" onsubmit="return confirm('Biztosan lemondod a rendelést?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-times me-2"></i>Rendelés lemondása
                                </button>
                            </form>
                        @endif
                        
                        @if($order->payment_status == 'pending' && $order->payment_method == 'card')
                            <a href="{{ route('orders.payment', $order->id) }}" class="btn btn-success">
                                <i class="fas fa-credit-card me-2"></i>Fizetés most
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8">
                    <!-- Termékek -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Rendelt termékek</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="text-muted small bg-light">
                                        <tr>
                                            <th scope="col" class="py-3 ps-4">Termék</th>
                                            <th scope="col" class="py-3 text-center">Ár</th>
                                            <th scope="col" class="py-3 text-center">Mennyiség</th>
                                            <th scope="col" class="py-3 pe-4 text-end">Összeg</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-top">
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset($item->image_path) }}" alt="{{ $item->product_name }}" 
                                                             class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover;" />
                                                        <div>
                                                            <h6 class="fw-bold mb-0">
                                                                @if($item->product)
                                                                    <a href="{{ route('products.show', $item->product_id) }}" class="text-dark text-decoration-none">
                                                                        {{ $item->product_name }}
                                                                    </a>
                                                                @else
                                                                    {{ $item->product_name }}
                                                                @endif
                                                            </h6>
                                                            @if($item->product && $item->product->category)
                                                                <span class="text-muted small">{{ $item->product->category->name }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ number_format($item->product_price, 0, ',', ' ') }} Ft</td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-end pe-4 fw-bold">{{ number_format($item->subtotal, 0, ',', ' ') }} Ft</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rendelési információk -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-white py-3">
                                    <h5 class="mb-0">Szállítási adatok</h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-1"><strong>Név:</strong> {{ $order->full_name }}</p>
                                    <p class="mb-1"><strong>Email:</strong> {{ $order->email }}</p>
                                    <p class="mb-1"><strong>Telefon:</strong> {{ $order->phone }}</p>
                                    <p class="mb-1"><strong>Cím:</strong> {{ $order->full_address }}</p>
                                    <p class="mb-0"><strong>Szállítási mód:</strong> {{ $order->shipping_method_text }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-white py-3">
                                    <h5 class="mb-0">Fizetési adatok</h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-1">
                                        <strong>Fizetési mód:</strong> {{ $order->payment_method_text }}
                                    </p>
                                    <p class="mb-1">
                                        <strong>Fizetés állapota:</strong>
                                        @switch($order->payment_status)
                                            @case('pending')
                                                <span class="badge bg-warning text-dark">{{ $order->payment_status_text }}</span>
                                                @break
                                            @case('paid')
                                                <span class="badge bg-success">{{ $order->payment_status_text }}</span>
                                                @break
                                            @case('failed')
                                                <span class="badge bg-danger">{{ $order->payment_status_text }}</span>
                                                @break
                                            @case('refunded')
                                                <span class="badge bg-info">{{ $order->payment_status_text }}</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ $order->payment_status_text }}</span>
                                        @endswitch
                                    </p>
                                    
                                    @if($order->payment_method == 'transfer')
                                        <div class="alert alert-info mt-3 mb-0">
                                            <h6 class="mb-2">Átutalási adatok:</h6>
                                            <p class="mb-1 small">Kedvezményezett: GamerShop Kft.</p>
                                            <p class="mb-1 small">Bankszámlaszám: 12345678-87654321-00000000</p>
                                            <p class="mb-1 small">Közlemény: {{ $order->order_number }}</p>
                                            <p class="mb-0 small">Összeg: {{ number_format($order->total, 0, ',', ' ') }} Ft</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($order->order_notes)
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0">Megjegyzés a rendeléshez</h5>
                            </div>
                            <div class="card-body">
                                {{ $order->order_notes }}
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="col-lg-4">
                    <!-- Összesítés -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Összesítés</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Részösszeg:</span>
                                <span>{{ number_format($order->subtotal, 0, ',', ' ') }} Ft</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Szállítási költség:</span>
                                <span>
                                    @if($order->shipping_cost > 0)
                                        {{ number_format($order->shipping_cost, 0, ',', ' ') }} Ft
                                    @else
                                        <span class="badge bg-success">Ingyenes</span>
                                    @endif
                                </span>
                            </div>
                            @if($order->discount > 0)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Kedvezmény:</span>
                                    <span class="text-danger">-{{ number_format($order->discount, 0, ',', ' ') }} Ft</span>
                                </div>
                            @endif
                            <hr>
                            <div class="d-flex justify-content-between fw-bold fs-5">
                                <span>Végösszeg:</span>
                                <span>{{ number_format($order->total, 0, ',', ' ') }} Ft</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rendelés követése (ha szállítás alatt van) -->
                    @if($order->order_status === 'shipped')
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0">Szállítás követése</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-3">A szállítási információkat emailben elküldtük. Alább is nyomon követheted a csomagod útját.</p>
                                
                                @if($order->shipping_method === 'courier')
                                    <a href="https://futar.hu/nyomkovetes?tracking_number=TRACK123456789" target="_blank" class="btn btn-primary w-100">
                                        <i class="fas fa-truck me-2"></i>Csomag követése
                                    </a>
                                @elseif($order->shipping_method === 'pickup_point')
                                    <a href="https://csomagpont.hu/nyomkovetes?tracking_number=TRACK123456789" target="_blank" class="btn btn-primary w-100">
                                        <i class="fas fa-box me-2"></i>Csomag követése
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    <!-- Segítség -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Segítségre van szükséged?</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-3">Ha bármilyen kérdésed van a rendeléssel kapcsolatban, fordulj ügyfélszolgálatunkhoz.</p>
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-phone me-2 text-primary"></i>
                                    <span>+36 1 234 5678</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-envelope me-2 text-primary"></i>
                                    <span>info@gamershop.hu</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-clock me-2 text-primary"></i>
                                    <span>H-P: 9:00 - 17:00</span>
                                </div>
                            </div>
                            <a href="{{ route('contact') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-comment-dots me-2"></i>Kapcsolatfelvétel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Rendelés állapot stílusok */
    .order-status .badge {
        font-size: 0.9rem;
        font-weight: 500;
        padding: 0.5rem 1rem;
    }
    
    /* Folyamat lépésjelző */
    .order-progress {
        margin-top: 2rem;
    }
    
    .order-progress-track {
        width: 100%;
        height: 4px;
        background-color: #e9ecef;
        border-radius: 4px;
        position: relative;
        margin-bottom: 2rem;
        overflow: hidden;
    }
    
    .order-progress-line {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        background-color: var(--bs-primary);
        transition: width 0.5s ease;
    }
    
    .order-progress-steps {
        display: flex;
        justify-content: space-between;
    }
    
    .order-progress-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        width: 25%;
        text-align: center;
    }
    
    .order-progress-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        color: #6c757d;
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }
    
    .order-progress-title {
        font-size: 0.85rem;
        color: #6c757d;
        font-weight: 500;
    }
    
    .order-progress-step.completed .order-progress-icon {
        background-color: var(--bs-primary);
        color: white;
    }
    
    .order-progress-step.completed .order-progress-title {
        color: var(--bs-primary);
    }
    
    .order-progress-step.cancelled .order-progress-icon {
        background-color: var(--bs-danger);
        color: white;
    }
    
    .order-progress-step.cancelled .order-progress-title {
        color: var(--bs-danger);
    }
    
    /* Reszponzív igazítások */
    @media (max-width: 768px) {
        .order-progress-title {
            font-size: 0.75rem;
        }
        
        .order-progress-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }
</style>
@endpush
@endsection