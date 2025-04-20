@extends('layouts.app')
@section('title', 'GamerShop - Profil szerkesztése')

@push('styles')
<style>
    .profile-edit-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .profile-header {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 1rem;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 1.5rem;
        border: 3px solid var(--bs-primary);
    }

    .form-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }

    .edit-hint {
        position: absolute;
        top: 0;
        right: 0;
        color: #6c757d;
        font-size: 0.8rem;
        opacity: 0.7;
    }

    .profile-image-upload {
        position: relative;
        max-width: 200px;
        margin: 0 auto 1rem;
    }

    .profile-image-upload input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .profile-image-upload .upload-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .profile-image-upload:hover .upload-overlay {
        opacity: 1;
    }
</style>
@endpush

@section('content')
<div class="container my-5">
    <div class="profile-edit-container">
        <div class="profile-header">
            <div class="profile-image-upload">
                <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/default-avatar.png') }}" 
                     alt="Profilkép" class="profile-avatar">
                <div class="upload-overlay">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
            <div>
                <h2>{{ $user->firstname }} {{ $user->lastname }}</h2>
                <p class="text-muted">{{ $user->email }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <input type="file" name="profile_image" id="profile_image" class="d-none" accept="image/*">

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="firstname" class="form-label">
                        Keresztnév 
                        <span class="edit-hint">(Kötelező)</span>
                    </label>
                    <input type="text" id="firstname" name="firstname" 
                           class="form-control @error('firstname') is-invalid @enderror" 
                           value="{{ old('firstname', $user->firstname) }}" 
                           required>
                    @error('firstname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label for="lastname" class="form-label">
                        Vezetéknév 
                        <span class="edit-hint">(Kötelező)</span>
                    </label>
                    <input type="text" id="lastname" name="lastname" 
                           class="form-control @error('lastname') is-invalid @enderror" 
                           value="{{ old('lastname', $user->lastname) }}" 
                           required>
                    @error('lastname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="email" class="form-label">
                        Email cím 
                        <span class="edit-hint">(Kötelező)</span>
                    </label>
                    <input type="email" id="email" name="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email', $user->email) }}" 
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label for="phone" class="form-label">
                        Telefonszám 
                        <span class="edit-hint">(Opcionális)</span>
                    </label>
                    <input type="tel" id="phone" name="phone" 
                           class="form-control @error('phone') is-invalid @enderror" 
                           value="{{ old('phone', $user->phone) }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="address_zip" class="form-label">
                        Irányítószám 
                        <span class="edit-hint">(Opcionális)</span>
                    </label>
                    <input type="text" id="address_zip" name="address_zip" 
                           class="form-control @error('address_zip') is-invalid @enderror" 
                           value="{{ old('address_zip', $user->address_zip) }}">
                    @error('address_zip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label for="address_city" class="form-label">
                        Város 
                        <span class="edit-hint">(Opcionális)</span>
                    </label>
                    <input type="text" id="address_city" name="address_city" 
                           class="form-control @error('address_city') is-invalid @enderror" 
                           value="{{ old('address_city', $user->address_city) }}">
                    @error('address_city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="address_street" class="form-label">
                        Utca, házszám 
                        <span class="edit-hint">(Opcionális)</span>
                    </label>
                    <input type="text" id="address_street" name="address_street" 
                           class="form-control @error('address_street') is-invalid @enderror" 
                           value="{{ old('address_street', $user->address_street) }}">
                    @error('address_street')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label for="address_additional" class="form-label">
                        Kiegészítő cím 
                        <span class="edit-hint">(Opcionális)</span>
                    </label>
                    <input type="text" id="address_additional" name="address_additional" 
                           class="form-control @error('address_additional') is-invalid @enderror" 
                           value="{{ old('address_additional', $user->address_additional) }}">
                    @error('address_additional')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i>Mentés
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Profilkép feltöltés kezelése
    const profileImageUpload = document.querySelector('.profile-image-upload');
    const fileInput = document.getElementById('profile_image');
    const profileAvatar = profileImageUpload.querySelector('img');

    profileImageUpload.addEventListener('click', function() {
        fileInput.click();
    });

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profileAvatar.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Hibaüzenetek automatikus eltűnése
    const errorAlerts = document.querySelectorAll('.alert-dismissible');
    errorAlerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 10000);
    });
});
</script>
@endpush