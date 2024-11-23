@extends('layouts.app')

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
      <form class="form" method="POST" action="{{ route('register') }}">
        @csrf
        <p class="title">Regisztráció</p>
        <p class="message">Regisztrálj most, és élvezd az alkalmazás összes funkcióját!</p>
        
        <div class="flex">
          <label>
            <input required type="text" name="firstname" class="input" placeholder="">
            <span>Keresztnév</span>
          </label>
          <label>
            <input required type="text" name="lastname" class="input" placeholder="">
            <span>Vezetéknév</span>
          </label>
        </div>
  
        <label>
          <input required type="email" name="email" class="input" placeholder="">
          <span>Email</span>
        </label>
  
        <label>
          <input required type="password" name="password" class="input" placeholder="">
          <span>Jelszó</span>
        </label>
  
        <label>
          <input required type="password" name="password_confirmation" class="input" placeholder="">
          <span>Jelszó megerősítése</span>
        </label>
  
        <button type="submit" class="submit">Regisztráció</button>
        
        <p class="signin">Van már fiókod? <a href="{{ route('login') }}">Jelentkezz be itt!</a></p>
      </form>
    </div>
  </div>
@endsection  