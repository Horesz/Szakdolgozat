@extends('layouts.app')
@section('title', 'GamerShop - Bejelentkezés')

@section('content')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

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

<div class="auth-page">
    <div class="form-container">
        <div class="title">Bejelentkezés</div>
        
        <!-- Bejelentkezési form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>
                <input type="email" name="email" class="input" placeholder=" " required />
                <span>Email cím</span>
            </label>
            <label>
                <input type="password" name="password" class="input" placeholder=" " required />
                <span>Jelszó</span>
            </label>
            <button type="submit" class="submit">Belépés</button>
        </form>

        <div class="signin">
            Nincs még fiókod? <a href="{{ route('register') }}">Regisztrálj itt!</a>
        </div>
    </div>
</div>
@endsection
