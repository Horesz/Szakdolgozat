<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Adminisztrátor Pult')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <!-- Navigációs sáv -->
        @include('admin.layouts.navbar')

        <!-- Tartalom -->
        @yield('content')
    </div>
</body>
</html>
