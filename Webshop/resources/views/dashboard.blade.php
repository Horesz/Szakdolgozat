@extends('layouts.app')

@section('title', 'GamerShop - Dashboard')

@section('content')
<div class="container">
    <h1>Üdvözlünk, {{ $user->name }}!</h1>
    <p>Ez a te személyre szabott vezérlőpultod.</p>

    <!-- Profil kártya -->
    <div class="card mt-4">
        <div class="card-header">Profilod</div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Telefon:</strong> {{ $user->phone ?? 'Nincs megadva' }}</p>
            <p><strong>Lakcím:</strong> 
                {{ $user->postal_code ?? '' }} 
                {{ $user->street ?? '' }} 
                {{ $user->house_number ?? '' }}
            </p>
            <!-- Profil szerkesztés gomb -->
            <a href="/profile" class="btn btn-primary">Profil szerkesztése</a>
        </div>
    </div>

    <!-- Adminisztrátor információk -->
    @if(Auth::user()->is_admin)
    <div class="alert alert-info mt-4">
        Adminisztrátor vagy.
        <a href="{{ route('admin.users.index') }}" class="btn btn-danger">Felhasználók kezelése</a>
    </div>
@endif


    <!-- Aktivitások -->
    @if(!empty($recentActivities))
        <h2>Legutóbbi aktivitásaid</h2>
        <ul>
            @foreach($recentActivities as $activity)
                <li>{{ $activity }}</li>
            @endforeach
        </ul>
    @else
        <p>Még nincsenek aktivitásaid.</p>
    @endif
</div>
@endsection
