@extends('layouts.app')

@section('title', 'GamerShop - Dashboard')

@section('content')
<div class="container">
    <h1>Üdvözlünk, {{ $user->full_name }}!</h1>
    <p>Ez a te személyre szabott vezérlőpultod.</p>
    
    @if($user->role === 'munkatars')
    <div class="alert alert-info mt-4">
        Munkatárs felhasználó.
    </div>
    @endif

    @if($user->role === 'admin')
    <div class="alert alert-info mt-4">
        Adminisztrátor felhasználó.
    </div>
    @endif

    @if($user->role === 'user')
    <div class="alert alert-info mt-4">
        Üdvözlünk a webshopban. Jó nézelődést.
    </div>
    @endif

    <!-- Profil kártya -->
    <div class="card mt-4">
        <div class="card-header">Személyes adatok</div>
        <div class="card-body text-center">

            <!-- Profilkép -->
            @if($user->profile_image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profilkép" style="max-width: 150px; border-radius: 50%;">
                </div>
            @else
                <div class="mb-3">
                    <img src="{{ asset('images/default-profile.png') }}" alt="Alapértelmezett profilkép" style="max-width: 150px; border-radius: 50%;">
                </div>
            @endif

            <!-- Személyes adatok -->
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
            <a href="{{ route('profile.edit') }}" class="btn text-white btn-primary mt-2">Profil szerkesztése</a>
        </div>
    </div>

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
