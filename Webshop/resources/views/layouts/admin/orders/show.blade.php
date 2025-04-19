@extends('layouts.admin')

@section('title', 'Rendelés részletei')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rendelés részletei - {{ $order->order_number }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Vásárló adatai</h5>
                            <p>
                                <strong>Név:</strong> {{ $order->full_name }}<br>
                                <strong>Email:</strong> {{ $order->email }}<br>
                                <strong>Telefon:</strong> {{ $order->phone }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>Szállítási cím</h5>
                            <p>
                                {{ $order->full_address }}
                            </p>
                        </div>
                    </div>

                    <hr>

                    <h5>Rendelt termékek</h5>
<table class="table">
    <thead>
        <tr>
            <th>Termék</th>
            <th>Mennyiség</th>
            <th>Egységár</th>
            <th>Összesen</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td>
                <div class="d-flex align-items-center">
                    @if($item->product && $item->product->image_path)
                        <img src="{{ asset('storage/'.$item->product->image_path) }}" alt="{{ $item->product_name }}" 
                             class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover;" 
                             onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';" />
                    @else
                        <img src="{{ asset('images/no-image.png') }}" alt="Nincs kép" 
                             class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover;" />
                    @endif
                    <span>{{ $item->product_name }}</span>
                </div>
            </td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->product_price, 0, ',', ' ') }} Ft</td>
            <td>{{ number_format($item->subtotal, 0, ',', ' ') }} Ft</td>
        </tr>
        @endforeach
    </tbody>
</table>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label>Rendelés státusza</label>
                                    <select name="order_status" class="form-control">
                                        <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Feldolgozás alatt</option>
                                        <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Feldolgozva</option>
                                        <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Szállítás alatt</option>
                                        <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Kézbesítve</option>
                                        <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Lemondva</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Státusz módosítása</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('admin.orders.update-payment-status', $order) }}">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label>Fizetési státusz</label>
                                    <select name="payment_status" class="form-control">
                                        <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Várakozás</option>
                                        <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Kifizetve</option>
                                        <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Sikertelen</option>
                                        <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Visszatérítve</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Fizetési státusz módosítása</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Összesítő</h3>
                </div>
                <div class="card-body">
                    <p><strong>Részösszeg:</strong> {{ number_format($order->subtotal, 0, ',', ' ') }} Ft</p>
                    <p><strong>Szállítási díj:</strong> {{ number_format($order->shipping_cost, 0, ',', ' ') }} Ft</p>
                    <p><strong>Kedvezmény:</strong> {{ number_format($order->discount, 0, ',', ' ') }} Ft</p>
                    <hr>
                    <p class="h4"><strong>Végösszeg:</strong> {{ number_format($order->total, 0, ',', ' ') }} Ft</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection