<head>
    <style>
      html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
  }
  
  main {
      flex: 1; /* Kitölti a rendelkezésre álló helyet */
  }
  
  footer {
      margin-top: auto; /* Az oldal aljára helyezi a footert */
  }
  
    </style>
  </head>
  

@extends('layouts.app')

@section('title', 'GamerShop - Dashboard')

@section('content')
<div class="container">
    <h1>Üdvözlünk, {{ $user->full_name }}!</h1>
    <p>Ez a te személyre szabott vezérlőpultod.</p>
    
    @if($user->role === 'munkatars')
    <div class="alert alert-info mt-4">
        Munkatárs vagy.
        {{-- <a href="{{ route('admin.dashboard') }}" class="btn btn-danger">Adminisztrációs felület</a> --}}
    </div>
    @endif
    <!-- Profil kártya -->
    <div class="card mt-4">
        <div class="card-header">Személyes adati: </div>
        <div class="card-body">
            <p><strong>Név:</strong> {{ $user->firstname }} {{ $user->lastname }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Telefonszám:</strong> {{ $user->phone ?? 'Nincs megadva' }}</p>
            <p><strong>Születési dátum:</strong> 
                {{ $user->birth_date ? $user->birth_date->format('Y-m-d') : 'Nincs megadva' }}
                ({{ $user->age ? $user->age . ' éves' : '' }})
            </p>
            <p><strong>Lakcím:</strong> 
                @if($user->address_zip || $user->address_city || $user->address_street || $user->address_additional)
                    {{ $user->address_zip }} 
                    {{ $user->address_city }}, 
                    {{ $user->address_street }} 
                    {{ $user->address_additional }}
                @else
                    Nincs megadva
                @endif
            </p>

            <!-- Profil szerkesztés gomb -->
            <a href="{{ route('profile.edit') }}" class="btn text-white btn-primary">Profil szerkesztése</a>
        </div>
    </div>

    <!-- Adminisztrátor információk -->
    

    <!-- Aktivitások -->
    @if(!empty($recentActivities))
        <div class="card mt-4">
            <div class="card-header">Legutóbbi aktivitásaid</div>
            <div class="card-body">
                <ul class="list-unstyled">
                    @foreach($recentActivities as $activity)
                        <li>{{ $activity }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
@endsection