<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rendelés visszaigazolása</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
        }
        .header {
            background-color: #343a40;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .order-details {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .product-table th, .product-table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }
        .product-table th {
            background-color: #e9ecef;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
            border-top: 1px solid #e9ecef;
            padding-top: 20px;
        }
        .total {
            font-weight: bold;
            font-size: 16px;
            text-align: right;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: white !important;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Köszönjük rendelésed!</h1>
        </div>
        
        <p>Kedves {{ $order->firstname }} {{ $order->lastname }}!</p>
        
        <p>Köszönjük, hogy a GamerShop webáruházat választottad! Az alábbiakban találod a rendelésed részleteit:</p>
        
        <div class="order-details">
            <p><strong>Rendelésszám:</strong> {{ $order->order_number }}</p>
            <p><strong>Rendelés dátuma:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
            <p><strong>Fizetési mód:</strong> 
                @if($order->payment_method == 'card')
                    Bankkártyás fizetés
                @elseif($order->payment_method == 'transfer')
                    Banki átutalás
                @else
                    Utánvét
                @endif
            </p>
            <p><strong>Fizetési státusz:</strong> 
                @if($order->payment_status == 'pending')
                    Függőben
                @elseif($order->payment_status == 'paid')
                    Kifizetve
                @else
                    Függőben
                @endif
            </p>
        </div>
        
        <h3>Rendelt termékek</h3>
        <table class="product-table">
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
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }} db</td>
                    <td>{{ number_format($item->product_price, 0, ',', ' ') }} Ft</td>
                    <td>{{ number_format($item->subtotal, 0, ',', ' ') }} Ft</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="total">
            <p>Részösszeg: {{ number_format($order->subtotal, 0, ',', ' ') }} Ft</p>
            <p>Szállítási költség: {{ number_format($order->shipping_cost, 0, ',', ' ') }} Ft</p>
            @if($order->discount > 0)
            <p>Kedvezmény: -{{ number_format($order->discount, 0, ',', ' ') }} Ft</p>
            @endif
            <p>Végösszeg: {{ number_format($order->total, 0, ',', ' ') }} Ft</p>
        </div>
        
        <p><strong>Szállítási cím:</strong></p>
        <p>
            {{ $order->firstname }} {{ $order->lastname }}<br>
            {{ $order->address_zip }} {{ $order->address_city }}<br>
            {{ $order->address_street }}
            @if($order->address_additional)
            <br>{{ $order->address_additional }}
            @endif
        </p>
        
        <p style="text-align: center; margin-top: 30px;">
            <a href="{{ route('orders.show', $order->id) }}" class="button">Rendelés részletei</a>
        </p>
        
        <p style="margin-top: 30px;">Ha kérdésed van a rendeléssel kapcsolatban, kérjük, vedd fel velünk a kapcsolatot a support@gamershop.hu e-mail címen vagy a +36 1 234 5678 telefonszámon.</p>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} GamerShop. Minden jog fenntartva.</p>
        </div>
    </div>
</body>
</html>