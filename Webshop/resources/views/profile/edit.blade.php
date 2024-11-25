@extends('layouts.app')
@section('title', 'GamerShop - Profil')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Profil szerkesztése</h3>
            
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Név</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Telefonszám</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="postal_code" class="form-label">Irányítószám</label>
                        <input type="text" id="postal_code" name="postal_code" class="form-control" value="{{ old('postal_code', auth()->user()->postal_code) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="street" class="form-label">Utca</label>
                        <input type="text" id="street" name="street" class="form-control" value="{{ old('street', auth()->user()->street) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="house_number" class="form-label">Házszám</label>
                        <input type="text" id="house_number" name="house_number" class="form-control" value="{{ old('house_number', auth()->user()->house_number) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="floor" class="form-label">Emelet</label>
                        <input type="text" id="floor" name="floor" class="form-control" value="{{ old('floor', auth()->user()->floor) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="door" class="form-label">Ajtó</label>
                        <input type="text" id="door" name="door" class="form-control" value="{{ old('door', auth()->user()->door) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="profile_image" class="form-label">Profilkép</label>
                        <input type="file" id="profile_image" name="profile_image" class="form-control">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4">Mentés</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
