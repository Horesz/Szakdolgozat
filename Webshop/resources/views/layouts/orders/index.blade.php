@extends('layouts.app')

@section('title', 'Rendeléseim - GamerShop')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4 fw-bold">Rendeléseim</h1>
            
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
            
            @if(count($orders) > 0)
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Korábbi rendelések</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="text-muted small bg-light">
                                    <tr>
                                        <th scope="col" class="py-3 ps-4">Rendelésszám</th>
                                        <th scope="col" class="py-3">Dátum</th>
                                        <th scope="col" class="py-3 text-center">Összeg</th>
                                        <th scope="col" class="py-3 text-center">Státusz</th>
                                        <th scope="col" class="py-3 text-center">Fizetés</th>
                                        <th scope="col" class="py-3 pe-4 text-end">Műveletek</th>
                                    </tr>
                                </thead>
                                <tbody class="border-top">
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="ps-4 fw-medium">{{ $order->order_number }}</td>
                                            <td>{{ $order->created_at->format('Y.m.d. H:i') }}</td>
                                            <td class="text-center fw-bold">{{ number_format($order->total, 0, ',', ' ') }} Ft</td>
                                            <td class="text-center">
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
                                            </td>
                                            <td class="text-center">
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
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i> Részletek
                                                    </a>
                                                    
                                                    @if($order->canBeCancelled())
                                                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Biztosan lemondod a rendelést?');">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                <i class="fas fa-times"></i> Lemondás
                                                            </button>
                                                        </form>
                                                    @endif
                                                    
                                                    @if($order->payment_status == 'pending' && $order->payment_method == 'card')
                                                        <a href="{{ route('orders.payment', $order->id) }}" class="btn btn-sm btn-success">
                                                            <i class="fas fa-credit-card"></i> Fizetés
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm p-5 text-center">
                    <div class="py-5">
                        <i class="fas fa-shopping-bag fa-5x text-muted mb-4"></i>
                        <h3>Még nincsenek rendeléseid</h3>
                        <p class="text-muted mb-4">Fedezd fel kínálatunkat és adj le egy rendelést</p>
                        <a href="{{ route('products.browse') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-store me-2"></i>Vásárlás most
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection