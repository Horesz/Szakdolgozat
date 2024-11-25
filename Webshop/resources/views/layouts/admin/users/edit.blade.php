@extends('admin.layouts.admin')

@section('title', 'Felhasználó szerkesztése')

@section('content')
    <h1>Felhasználó szerkesztése</h1>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Név</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Telefon</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
        </div>

        <button type="submit" class="btn btn-primary">Frissítés</button>
    </form>
@endsection
