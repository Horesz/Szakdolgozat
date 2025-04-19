<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Válasz a megkeresésedre - GamerShop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #121836;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            color: white;
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .original-message {
            background-color: #f0f0f0;
            border-left: 4px solid #0095FF;
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 5px 5px 0;
        }
        .reply-message {
            background-color: white;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #777;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .primary-color {
            color: #0095FF;
        }
        .cta-button {
            display: inline-block;
            background-color: #0095FF;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .info-row {
            margin-bottom: 15px;
        }
        .info-label {
            font-weight: bold;
            color: #121836;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo-white.png') }}" alt="GamerShop Logo" class="logo">
            <h1>Válasz a megkeresésedre</h1>
        </div>
        
        <div class="content">
            <p>Kedves {{ $contactMessage->name }}!</p>
            <p>Köszönjük, hogy felvetted velünk a kapcsolatot. Az alábbiakban találod a válaszunkat a megkeresésedre.</p>
            
            <div class="original-message">
                <div class="info-row">
                    <p><span class="info-label">Eredeti üzenet:</span> {{ $contactMessage->subject }}</p>
                    <p><span class="info-label">Küldés ideje:</span> {{ $contactMessage->created_at->format('Y-m-d H:i') }}</p>
                </div>
                <p>"{{ $contactMessage->message }}"</p>
            </div>
            
            <div class="reply-message">
                <h3>Válaszunk:</h3>
                <p>{!! nl2br(e($replyMessage)) !!}</p>
            </div>
            
            <p class="mt-4">Ha további kérdéseid lennének, kérjük, ne habozz felvenni velünk a kapcsolatot újra a kapcsolati űrlapunkon keresztül, vagy az alábbi elérhetőségeken:</p>
            
            <ul>
                <li>Telefonszám: +36 1 123 4567 (H-P: 9:00-17:00)</li>
                <li>E-mail: info@gamershop.hu</li>
                <li>Személyes ügyfélszolgálat: 1134 Budapest, Gamer utca 42. (H-P: 10:00-18:00, Szo: 10:00-14:00)</li>
            </ul>
            
            <div style="text-align: center;">
                <a href="{{ route('products.browse') }}" class="cta-button">
                    Fedezd fel termékeinket
                </a>
            </div>
            
            <p>Üdvözlettel,<br>
            <span class="primary-color">GamerShop</span> Ügyfélszolgálat</p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} GamerShop. Minden jog fenntartva.</p>
            <p>1134 Budapest, Gamer utca 42. | Tel: +36 1 123 4567 | E-mail: info@gamershop.hu</p>
            <p>Ezt az e-mailt azért kaptad, mert kapcsolatba léptél velünk. Ez egy automatikus válasz, kérjük, ne válaszolj erre az e-mailre.</p>
        </div>
    </div>
</body>
</html>