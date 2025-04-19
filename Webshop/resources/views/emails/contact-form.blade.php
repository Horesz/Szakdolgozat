<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Új kapcsolatfelvételi üzenet - GamerShop</title>
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
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .info-row {
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }
        .info-label {
            font-weight: bold;
            color: #121836;
        }
        .message-box {
            background-color: white;
            border: 1px solid #ddd;
            padding: 15px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo-white.png') }}" alt="GamerShop Logo" class="logo">
            <h1>Új kapcsolatfelvételi üzenet</h1>
        </div>
        
        <div class="content">
            <p>Tisztelt Adminisztrátor!</p>
            <p>Új kapcsolatfelvételi üzenet érkezett a GamerShop weboldalról az alábbi adatokkal:</p>
            
            <div class="info-row">
                <p><span class="info-label">Név:</span> {{ $formData['name'] }}</p>
            </div>
            
            <div class="info-row">
                <p><span class="info-label">E-mail cím:</span> <a href="mailto:{{ $formData['email'] }}">{{ $formData['email'] }}</a></p>
            </div>
            
            <div class="info-row">
                <p><span class="info-label">Tárgy:</span> {{ $formData['subject'] }}</p>
            </div>
            
            <div class="info-row">
                <p><span class="info-label">Téma:</span> 
                @php
                    $topics = [
                        'general' => 'Általános kérdés',
                        'order' => 'Rendeléssel kapcsolatos',
                        'product' => 'Termékkel kapcsolatos',
                        'warranty' => 'Garancia, szerviz',
                        'other' => 'Egyéb'
                    ];
                @endphp
                {{ $topics[$formData['topic']] ?? $formData['topic'] }}
                </p>
            </div>
            
            <div class="info-row">
                <p><span class="info-label">Üzenet:</span></p>
                <div class="message-box">
                    {{ $formData['message'] }}
                </div>
            </div>
            
            <p>Kérjük, válaszoljon az ügyfélnek a lehető leghamarabb az <a href="mailto:{{ $formData['email'] }}">{{ $formData['email'] }}</a> e-mail címen.</p>
            
            <p>Üdvözlettel,<br>
            <span class="primary-color">GamerShop</span> Automatikus Értesítő Rendszer</p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} GamerShop. Minden jog fenntartva.</p>
            <p>1134 Budapest, Gamer utca 42. | Tel: +36 1 123 4567 | E-mail: info@gamershop.hu</p>
        </div>
    </div>
</body>
</html>