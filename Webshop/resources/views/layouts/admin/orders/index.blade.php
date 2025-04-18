@extends('layouts.admin')

@section('title', 'Rendelések kezelése')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rendelések kezelése</h3>
                    <div class="card-tools">
                        <form method="GET" class="form-inline">
                            <select name="status" class="form-control mr-2">
                                <option value="">Összes státusz</option>
                                <option value="pending">Feldolgozás alatt</option>
                                <option value="processing">Feldolgozva</option>
                                <option value="shipped">Szállítás alatt</option>
                                <option value="delivered">Kézbesítve</option>
                            </select>
                            <input type="date" name="start_date" class="form-control mr-2">
                            <input type="date" name="end_date" class="form-control mr-2">
                            <button type="submit" class="btn btn-primary">Szűrés</button>
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Rendelésszám</th>
                                <th>Vásárló</th>
                                <th>Összeg</th>
                                <th>Státusz</th>
                                <th>Fizetés</th>
                                <th>Dátum</th>
                                <th>Műveletek</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->full_name }}</td>
                                <td>{{ number_format($order->total, 0, ',', ' ') }} Ft</td>
                                <td>
                                    <span class="badge 
                                        @switch($order->order_status)
                                            @case('pending') bg-warning @break
                                            @case('processing') bg-info @break
                                            @case('shipped') bg-primary @break
                                            @case('delivered') bg-success @break
                                            @case('cancelled') bg-danger @break
                                        @endswitch
                                    ">
                                        {{ $order->order_status_text }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge 
                                        @switch($order->payment_status)
                                            @case('pending') bg-warning @break
                                            @case('paid') bg-success @break
                                            @case('failed') bg-danger @break
                                        @endswitch
                                    ">
                                        {{ $order->payment_status_text }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Részletek
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection