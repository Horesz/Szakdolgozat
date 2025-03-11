<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GamerShop')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Saját CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <!-- favicon -->

    <link rel="icon" type="image/png" href="{{ asset('images/Gamershop.png') }}">

    <style>body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1200px;
        }</style>
</head>
<body class="bg-light">
    
    <!-- Navigációs menü -->
    @include('layouts.navigation')

    <!-- Tartalom -->
    <main>
        @yield('content')
    </main>

    <!-- Lábléc -->
    <footer class="py-4 bg-dark text-white text-center">
        <div class="container">
            <p>&copy; {{ date('Y') }} GamerShop. Minden jog fenntartva.</p>
            <p>Készítette: <a href="https://github.com/horesz" class="text-white text-decoration-underline">Sinka Barnabás</a></p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @stack('scripts')
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible" id="error-alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    <script>
        setTimeout(function() {
            document.getElementById("error-alert").style.display = "none";
        }, 10000); // 10 másodperc után eltűnik
    </script>
@endif

</body>
</html>
