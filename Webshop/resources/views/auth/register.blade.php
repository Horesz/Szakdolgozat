@extends('layouts.app')

@section('title', 'GamerShop - Regisztráció')

@push('styles')
<style>
    :root {
        --gradient-primary: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        --gradient-secondary: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
    }

    .register-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(45deg, #f4f4f4 0%, #e9e9e9 100%);
        padding: 2rem 0;
    }

    .register-container {
        width: 100%;
        max-width: 1000px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        display: flex;
        overflow: hidden;
        perspective: 1000px;
    }

    .register-visual {
        flex: 0 0 40%;
        background: var(--gradient-primary);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
        padding: 2rem;
        transform: translateZ(50px);
    }

    .register-visual h2 {
        font-weight: bold;
        margin-bottom: 1rem;
        letter-spacing: 1px;
    }

    .register-visual p {
        opacity: 0.8;
        line-height: 1.6;
    }

    .register-form {
        flex: 0 0 60%;
        padding: 3rem 4rem;
        background: white;
    }

    .password-hint {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: 0 0 5px 5px;
        padding: 10px;
        display: none;
        z-index: 10;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        font-size: 0.8rem;
        color: #6c757d;
    }

    .password-hint-icon {
        cursor: help;
        color: #6c757d;
        margin-left: 5px;
    }

    .password-hint-icon:hover + .password-hint {
        display: block;
    }

    .form-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-control {
        border: none;
        border-bottom: 2px solid #e0e0e0;
        border-radius: 0;
        padding: 10px 0;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .form-control:focus {
        outline: none;
        border-bottom-color: var(--bs-primary);
        box-shadow: none;
    }

    .form-label {
        position: absolute;
        top: 10px;
        left: 0;
        color: #999;
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .form-control:focus + .form-label,
    .form-control:not(:placeholder-shown) + .form-label {
        top: -20px;
        font-size: 0.8rem;
        color: var(--bs-primary);
    }

    .form-control::placeholder {
        color: transparent;
    }

    .form-control.is-valid {
        background-image: none;
        border-bottom-color: #28a745;
    }

    .form-control.is-invalid {
        background-image: none;
        border-bottom-color: #dc3545;
    }

    .validation-icon {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        display: none;
    }

    .form-control.is-valid + .valid-icon {
        display: block;
        color: #28a745;
    }

    .form-control.is-invalid + .invalid-icon {
        display: block;
        color: #dc3545;
    }

    .btn-register {
        background: var(--gradient-primary);
        border: none;
        color: white;
        padding: 12px;
        border-radius: 50px;
        transition: transform 0.3s ease;
    }

    .btn-register:hover {
        transform: scale(1.05);
        color:white;
    }

    .login-link {
        text-align: center;
        margin-top: 1rem;
    }

    @media (max-width: 768px) {
        .register-container {
            flex-direction: column;
        }

        .register-visual, .register-form {
            flex: 0 0 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="register-wrapper">
    <div class="register-container">
        <div class="register-visual">
            <div class="text-center">
                <h2>Üdvözlünk a GamerShop-ban!</h2>
                <p>Regisztrálj most és légy részese a legújabb gaming élményeknek. Exkluzív ajánlatok, gyors szállítás, és rengeteg játék vár rád!</p>
                <img src="/images/about/iroda.png" alt="Gaming Illustration" class="img-fluid mt-4" style="max-width: 250px;">
            </div>
        </div>

        <div class="register-form">
            <h3 class="text-center mb-4">Regisztráció</h3>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Hiba a regisztráció során!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form id="registrationForm" method="POST" action="{{ route('register') }}" novalidate>
                @csrf
                
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control" id="lastname" name="lastname" 
                               value="{{ old('lastname') }}" required
                               minlength="2" maxlength="50"
                               pattern="[A-Za-zÁÉÍÓÖŐÚŰáéíóöőúű]+"
                               placeholder="Vezetéknév"
                               title="Csak betűk szerepelhetnek (ékezetes betűk is)">
                        <label for="lastname" class="form-label">Vezetéknév</label>
                        <i class="fas fa-check validation-icon valid-icon"></i>
                        <i class="fas fa-times validation-icon invalid-icon"></i>
                    </div>

                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control" id="firstname" name="firstname" 
                               value="{{ old('firstname') }}" required 
                               minlength="2" maxlength="50"
                               pattern="[A-Za-zÁÉÍÓÖŐÚŰáéíóöőúű]+"
                               placeholder="Keresztnév"
                               title="Csak betűk szerepelhetnek (ékezetes betűk is)">
                        <label for="firstname" class="form-label">Keresztnév</label>
                        <i class="fas fa-check validation-icon valid-icon"></i>
                        <i class="fas fa-times validation-icon invalid-icon"></i>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ old('email') }}" required
                               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                               placeholder="Email cím"
                               title="Kérem adjon meg egy érvényes email címet">
                        <label for="email" class="form-label">Email cím</label>
                        <i class="fas fa-check validation-icon valid-icon"></i>
                        <i class="fas fa-times validation-icon invalid-icon"></i>
                    </div>

                    <div class="col-md-6 form-group">
                        <input type="tel" class="form-control" id="phone" name="phone" 
                               value="{{ old('phone') }}"
                               pattern="^(\+36|06)?[0-9]{9}$"
                               placeholder="Telefonszám"
                               title="Kérem adjon meg egy érvényes magyar telefonszámot (pl. +36301234567)">
                        <label for="phone" class="form-label">Telefonszám</label>
                        <i class="fas fa-check validation-icon valid-icon"></i>
                        <i class="fas fa-times validation-icon invalid-icon"></i>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="date" class="form-control" id="birth_date" name="birth_date" 
                               value="{{ old('birth_date') }}"
                               max="{{ now()->subYears(16)->format('Y-m-d') }}"
                               placeholder="Születési dátum"
                               title="Csak 16 év feletti felhasználók regisztrálhatnak">
                        <label for="birth_date" class="form-label">Születési dátum</label>
                        <i class="fas fa-check validation-icon valid-icon"></i>
                        <i class="fas fa-times validation-icon invalid-icon"></i>
                    </div>

                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control" id="address_zip" name="address_zip" 
                               value="{{ old('address_zip') }}"
                               pattern="[0-9]{4}"
                               placeholder="Irányítószám"
                               title="Kérem adjon meg egy érvényes 4 számjegyű irányítószámot">
                        <label for="address_zip" class="form-label">Irányítószám</label>
                        <i class="fas fa-check validation-icon valid-icon"></i>
                        <i class="fas fa-times validation-icon invalid-icon"></i>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control" id="address_city" name="address_city" 
                               value="{{ old('address_city') }}"
                               minlength="2" maxlength="50"
                               pattern="[A-Za-zÁÉÍÓÖŐÚŰáéíóöőúű\s]+"
                               placeholder="Város"
                               title="Kérem adjon meg egy érvényes várost">
                        <label for="address_city" class="form-label">Város</label>
                        <i class="fas fa-check validation-icon valid-icon"></i>
                        <i class="fas fa-times validation-icon invalid-icon"></i>
                    </div>

                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control" id="address_street" name="address_street" 
                               value="{{ old('address_street') }}"
                               minlength="3" maxlength="100"
                               placeholder="Utca, házszám"
                               title="Kérem adja meg a pontos lakcímét">
                        <label for="address_street" class="form-label">Utca, házszám</label>
                        <i class="fas fa-check validation-icon valid-icon"></i>
                        <i class="fas fa-times validation-icon invalid-icon"></i>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required
                                   minlength="8"
                                   pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"
                                   placeholder="Jelszó"
                                   title="Minimum 8 karakter, tartalmazzon betűt, számot és speciális karaktert">
                            <button class="btn btn-outline-secondary toggle-password" type="button" 
                                    data-target="#password">
                                <i class="fas fa-eye"></i>
                            </button>
                            <i class="fas fa-info-circle password-hint-icon"></i>
                            <div class="password-hint">
                                A jelszónak meg kell felelnie az alábbi szabályoknak:
                                <ul>
                                    <li>Minimum 8 karakter hosszú</li>
                                    <li>Tartalmazzon betűket</li>
                                    <li>Tartalmazzon számokat</li>
                                    <li>Tartalmazzon speciális karaktereket (@$!%*#?&)</li>
                                </ul>
                            </div>
                        </div>
                        <label for="password" class="form-label">Jelszó</label>
                        <i class="fas fa-check validation-icon valid-icon"></i>
                        <i class="fas fa-times validation-icon invalid-icon"></i>
                    </div>

                    <div class="col-md-6 form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" id="password_confirmation" 
                                   name="password_confirmation" required
                                   placeholder="Jelszó megerősítése">
                            <button class="btn btn-outline-secondary toggle-password" type="button" 
                                    data-target="#password_confirmation">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <label for="password_confirmation" class="form-label">Jelszó megerősítése</label>
                        <i class="fas fa-check validation-icon valid-icon"></i>
                        <i class="fas fa-times validation-icon invalid-icon"></i>
                      </div>
                    </div>
    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-register w-100">
                            <i class="fas fa-user-plus me-2"></i>Regisztráció
                        </button>
                    </div>
    
                    <div class="login-link">
                        <p class="text-muted">
                            Már van fiókod? 
                            <a href="{{ route('login') }}" class="text-primary">Jelentkezz be!</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hibák automatikus eltűnése
        const errorAlerts = document.querySelectorAll('.alert-dismissible');
        errorAlerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 10000);
        });
    
        // Jelszó láthatóság váltása
        const togglePasswordButtons = document.querySelectorAll('.toggle-password');
        togglePasswordButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordField = document.querySelector(targetId);
                const icon = this.querySelector('i');
    
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    
        // Form validáció
        const form = document.getElementById('registrationForm');
        const inputs = form.querySelectorAll('input');
    
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                validateInput(this);
            });
        });
    
        function validateInput(input) {
            if (input.validity.valid) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
            }
        }
    
        // Jelszó megerősítés egyezésének ellenőrzése
        const passwordInput = document.getElementById('password');
        const passwordConfirmInput = document.getElementById('password_confirmation');
    
        passwordConfirmInput.addEventListener('input', function() {
            if (passwordInput.value === passwordConfirmInput.value) {
                passwordConfirmInput.setCustomValidity('');
            } else {
                passwordConfirmInput.setCustomValidity('A jelszavaknak meg kell egyezniük');
            }
            validateInput(passwordConfirmInput);
        });
    });
    </script>
    @endpush