@extends('layouts.app')

@section('title', 'Sikeres rendelés - GamerShop')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="card border-0 shadow-sm text-center p-5 mb-4">
                <div class="mb-4">
                    <div class="thank-you-icon mb-4">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <h1 class="h3 mb-3">Köszönjük a rendelésed!</h1>
                    <p class="lead mb-2">A rendelés sikeresen leadva</p>
                    <p class="mb-4">Rendelésszám: <strong>{{ $order->order_number }}</strong></p>
                    <div class="d-flex justify-content-center">
                        <div class="order-status">
                            <span class="badge bg-info text-white py-2 px-3">{{ $order->status_text }}</span>
                        </div>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <div class="row">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h5 class="mb-3">Rendelési adatok</h5>
                        <div class="text-start">
                            <p class="mb-1"><strong>Név:</strong> {{ $order->full_name }}</p>
                            <p class="mb-1"><strong>Email:</strong> {{ $order->email }}</p>
                            <p class="mb-1"><strong>Telefon:</strong> {{ $order->phone }}</p>
                            <p class="mb-0"><strong>Rendelés ideje:</strong> {{ $order->created_at->format('Y.m.d. H:i') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Szállítási adatok</h5>
                        <div class="text-start">
                            <p class="mb-1"><strong>Cím:</strong> {{ $order->full_address }}</p>
                            <p class="mb-1"><strong>Szállítási mód:</strong> {{ $order->shipping_method_text }}</p>
                            <p class="mb-0"><strong>Fizetési mód:</strong> {{ $order->payment_method_text }}</p>
                        </div>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <h5 class="mb-3">Rendelt termékek</h5>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <thead class="text-muted small bg-light">
                            <tr>
                                <th scope="col" class="text-start">Termék</th>
                                <th scope="col" class="text-center">Ár</th>
                                <th scope="col" class="text-center">Mennyiség</th>
                                <th scope="col" class="text-end">Összesen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="text-start">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($item->image_path) }}" alt="{{ $item->product_name }}" 
                                                 class="img-thumbnail me-3" style="width: 50px; height: 50px; object-fit: cover;" />
                                            <div>
                                                {{ $item->product_name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ number_format($item->product_price, 0, ',', ' ') }} Ft</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">{{ number_format($item->subtotal, 0, ',', ' ') }} Ft</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="border-top">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Részösszeg:</td>
                                <td class="text-end">{{ number_format($order->subtotal, 0, ',', ' ') }} Ft</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Szállítási költség:</td>
                                <td class="text-end">
                                    @if($order->shipping_cost > 0)
                                        {{ number_format($order->shipping_cost, 0, ',', ' ') }} Ft
                                    @else
                                        <span class="badge bg-success">Ingyenes</span>
                                    @endif
                                </td>
                            </tr>
                            @if($order->discount > 0)
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Kedvezmény:</td>
                                    <td class="text-end text-danger">-{{ number_format($order->discount, 0, ',', ' ') }} Ft</td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Végösszeg:</td>
                                <td class="text-end fw-bold fs-5">{{ number_format($order->total, 0, ',', ' ') }} Ft</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                @if($order->order_notes)
                    <div class="alert alert-light mt-4 text-start">
                        <strong>Megjegyzés a rendeléshez:</strong><br>
                        {{ $order->order_notes }}
                    </div>
                @endif
                
                <div class="mt-4">
                    <div class="alert alert-primary mb-4">
                        <i class="fas fa-info-circle me-2"></i>
                        A rendelésed részleteiről visszaigazoló e-mailt küldtünk a megadott e-mail címre.
                    </div>
                    
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                        <a href="{{ route('orders.index') }}" class="btn btn-primary">
                            <i class="fas fa-receipt me-2"></i>Rendeléseim megtekintése
                        </a>
                        <a href="{{ route('products.browse') }}" class="btn btn-outline-primary">
                            <i class="fas fa-shopping-bag me-2"></i>Vásárlás folytatása
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .thank-you-icon {
        font-size: 80px;
        margin-bottom: 1.5rem;
        color: #28a745;
    }
    
    .order-status {
        margin-top: 1rem;
        font-size: 1.1rem;
    }
    
    .order-status .badge {
        font-weight: 400;
        font-size: 0.9rem;
    }
</style>
@endpush
@endsection