<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rendelés státusz frissítés</title>
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
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            margin: 5px 0;
        }
        .status-pending { background-color: #ffc107; color: #212529; }
        .status-processing { background-color: #17a2b8; color: white; }
        .status-shipped { background-color: #007bff; color: white; }
        .status-delivered { background-color: #28a745; color: white; }
        .status-cancelled { background-color: #dc3545; color: white; }
        .status-paid { background-color: #28a745; color: white; }
        .status-failed { background-color: #dc3545; color: white; }
        .status-refunded { background-color: #6c757d; color: white; }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
            border-top: 1px solid #e9ecef;
            padding-top: 20px;
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
            <h1>Rendelésed státusza megváltozott</h1>
        </div>
        
        <p>Kedves {{ $order->firstname }} {{ $order->lastname }}!</p>
        
        <p>Örömmel értesítünk, hogy rendelésed státusza megváltozott.</p>
        
        <div class="order-details">
            <p><strong>Rendelésszám:</strong> {{ $order->order_number }}</p>
            <p><strong>Rendelés dátuma:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
            
            @if($isPaymentStatusUpdate)
                <p><strong>Fizetési státusz változás:</strong></p>
                <p>
                    <span class="status-badge status-{{ $oldStatus }}">
                        {{ $oldStatus == 'pending' ? 'Függőben' : 
                          ($oldStatus == 'paid' ? 'Kifizetve' : 
                          ($oldStatus == 'failed' ? 'Sikertelen' : 'Visszatérítve')) }}
                    </span>
                    &rarr;
                    <span class="status-badge status-{{ $newStatus }}">
                        {{ $newStatus == 'pending' ? 'Függőben' : 
                          ($newStatus == 'paid' ? 'Kifizetve' : 
                          ($newStatus == 'failed' ? 'Sikertelen' : 'Visszatérítve')) }}
                    </span>
                </p>
            @else
                <p><strong>Rendelés státusz változás:</strong></p>
                <p>
                    <span class="status-badge status-{{ $oldStatus }}">
                        {{ $oldStatus == 'pending' ? 'Feldolgozás alatt' : 
                          ($oldStatus == 'processing' ? 'Feldolgozva' : 
                          ($oldStatus == 'shipped' ? 'Szállítás alatt' : 
                          ($oldStatus == 'delivered' ? 'Kézbesítve' : 
                          ($oldStatus == 'cancelled' ? 'Lemondva' : 'Egyéb')))) }}
                    </span>
                    &rarr;
                    <span class="status-badge status-{{ $newStatus }}">
                        {{ $newStatus == 'pending' ? 'Feldolgozás alatt' : 
                          ($newStatus == 'processing' ? 'Feldolgozva' : 
                          ($newStatus == 'shipped' ? 'Szállítás alatt' : 
                          ($newStatus == 'delivered' ? 'Kézbesítve' : 
                          ($newStatus == 'cancelled' ? 'Lemondva' : 'Egyéb')))) }}
                    </span>
                </p>
            @endif
        </div>
        
        @if($newStatus == 'shipped')
            <p>Rendelésed úton van! Várható kézbesítési idő: 1-3 munkanap.</p>
            
            @if($order->shipping_method == 'courier')
                <p>A futárszolgálat hamarosan felveszi veled a kapcsolatot a kézbesítés részleteivel kapcsolatban.</p>
            @elseif($order->shipping_method == 'pickup_point')
                <p>Az értesítést követően a csomagot az általad választott átvételi ponton veheted át.</p>
            @endif
        @elseif($newStatus == 'delivered')
            <p>Rendelésed sikeresen kézbesítve lett! Reméljük, elégedett vagy a termékekkel!</p>
        @elseif($newStatus == 'processing')
            <p>Rendelésed feldolgozása megkezdődött, és hamarosan elkészítjük a csomagot a szállításra.</p>
        @elseif($newStatus == 'cancelled')
            <p>Sajnálattal értesítünk, hogy rendelésed lemondásra került.</p>
            <p>Ha kérdésed van a lemondással kapcsolatban, kérjük, vedd fel velünk a kapcsolatot.</p>
        @elseif($isPaymentStatusUpdate && $newStatus == 'paid')
            <p>Sikeresen regisztráltuk a fizetésedet. Köszönjük!</p>
        @elseif($isPaymentStatusUpdate && $newStatus == 'refunded')
            <p>A rendelés összegét visszatérítettük. A visszatérítés 5-10 munkanapon belül jelenik meg a számládon.</p>
        @endif
        
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