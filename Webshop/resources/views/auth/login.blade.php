@extends('layouts.app')

@section('title', 'GamerShop - Bejelentkezés')

@push('styles')
<style>
    :root {
        --gradient-primary: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        --gradient-secondary: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
    }

    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(45deg, #f4f4f4 0%, #e9e9e9 100%);
        padding: 2rem 0;
    }

    .login-container {
        width: 100%;
        max-width: 1000px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        display: flex;
        overflow: hidden;
        perspective: 1000px;
    }

    .login-visual {
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

    .login-visual h2 {
        font-weight: bold;
        margin-bottom: 1rem;
        letter-spacing: 1px;
    }

    .login-visual p {
        opacity: 0.8;
        line-height: 1.6;
    }

    .login-form {
        flex: 0 0 60%;
        padding: 3rem 4rem;
        background: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
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

    .btn-login {
        background: var(--gradient-primary);
        border: none;
        color: white;
        padding: 12px;
        border-radius: 50px;
        transition: transform 0.3s ease;
    }

    .btn-login:hover {
        transform: scale(1.05);
    }

    .register-link {
        text-align: center;
        margin-top: 1rem;
    }

    .password-reset-link {
        text-align: right;
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .login-container {
            flex-direction: column;
        }

        .login-visual, .login-form {
            flex: 0 0 100%;
        }
    }

    .validation-icon {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        display: none;
    }

    .form-control.is-valid {
        background-image: none;
        border-bottom-color: #28a745;
    }

    .form-control.is-invalid {
        background-image: none;
        border-bottom-color: #dc3545;
    }

    .form-control.is-valid + .valid-icon {
        display: block;
        color: #28a745;
    }

    .form-control.is-invalid + .invalid-icon {
        display: block;
        color: #dc3545;
    }
</style>
@endpush

@section('content')
<div class="login-wrapper">
    <div class="login-container">
        <div class="login-visual">
            <div class="text-center">
                <h2>Üdvözlünk újra!</h2>
                <p>Jelentkezz be és folytasd a gaming kalandozást a GamerShop-ban. Exkluzív ajánlatok, új játékok és még több élmény vár!</p>
                <img src="/images/about/iroda.png" alt="Gaming Login Illustration" class="img-fluid mt-4" style="max-width: 250px;">
            </div>
        </div>

        <div class="login-form">
            <h3 class="text-center mb-4">Bejelentkezés</h3>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Hiba a bejelentkezés során!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="password-reset-link">
                <a href="{{ route('password.request') }}" class="text-muted">Elfelejtetted a jelszavad?</a>
            </div>

            <form id="loginForm" method="POST" action="{{ route('login') }}" novalidate>
                @csrf
                
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" 
                           required
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                           placeholder="Email cím"
                           title="Kérem adjon meg egy érvényes email címet">
                    <label for="email" class="form-label">Email cím</label>
                    <i class="fas fa-check validation-icon valid-icon"></i>
                    <i class="fas fa-times validation-icon invalid-icon"></i>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" 
                               required
                               placeholder="Jelszó">
                        <button class="btn btn-outline-secondary toggle-password" type="button" 
                                data-target="#password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <label for="password" class="form-label">Jelszó</label>
                </div>

                <div class="form-group mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Emlékezz rám
                        </label>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-login w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>Belépés
                    </button>
                </div>

                <div class="register-link">
                    <p class="text-muted">
                        Nincs még fiókod? 
                        <a href="{{ route('register') }}" class="text-primary">Regisztrálj most!</a>
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

    // Email validáció
    const emailInput = document.getElementById('email');
    
    emailInput.addEventListener('input', function() {
        if (emailInput.validity.valid) {
            emailInput.classList.remove('is-invalid');
            emailInput.classList.add('is-valid');
        } else {
            emailInput.classList.remove('is-valid');
            emailInput.classList.add('is-invalid');
        }
    });
});
</script>
@endpush