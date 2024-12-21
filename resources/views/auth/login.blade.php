@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="background-overlay"></div>
        <div class="content-wrapper">
            <div class="logo-section">
                <img src="{{ asset('assets/img/clients/client-3.png') }}" alt="Logo" class="logo">
                <h2 class="system-name">Sistema Médico</h2>
            </div>

            <div class="flip-card" id="flipCard">
                <div class="flip-card-inner">
                    <!-- Login Form Front -->
                    <div class="flip-card-front">
                        <div class="form-header">
                            
                            <h1>Bienvenido</h1>
                            <p>Ingresa tus credenciales para continuar</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf
                            <div class="form-group">
                                <i class="fas fa-envelope input-icon"></i>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="Correo electrónico">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <i class="fas fa-lock input-icon"></i>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password" placeholder="Contraseña">
                                <div class="password-toggle" onclick="togglePasswordVisibility()">
                                    <i class="far fa-eye" id="togglePassword"></i>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group remember-me">
                                <label class="checkbox-container">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                    Recordarme
                                </label>
                            </div>

                            <button type="submit" class="login-button">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                            </button>
                        </form>

                        <div class="form-footer">
                            <p>¿No tienes una cuenta?</p>
                            <span class="toggle-text" id="registerText">Registrarse</span>
                        </div>
                    </div>

                    <!-- Register Form Back -->
                    <div class="flip-card-back">
                        <div class="form-header">
                            <h2>Crear Cuenta</h2>
                        </div>

                        <form id="registerForm" method="POST" action="{{ route('register') }}" class="register-form">
                            @csrf
                            <div class="form-group">
                                <i class="fas fa-user input-icon"></i>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                    name="name" value="{{ old('name') }}" required placeholder="Nombre completo">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <i class="fas fa-envelope input-icon"></i>
                                <input id="register_email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                    name="email" value="{{ old('email') }}" required placeholder="Correo electrónico">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <i class="fas fa-lock input-icon"></i>
                                <input id="register_password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                    name="password" required placeholder="Contraseña">
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <i class="fas fa-lock input-icon"></i>
                                <input id="password-confirm" type="password" class="form-control" 
                                    name="password_confirmation" required placeholder="Confirmar contraseña">
                            </div>

                            <button type="submit" class="register-button">
                                <i class="fas fa-user-plus"></i> Registrarse
                            </button>
                        </form>

                        <div class="form-footer">
                            <p>¿Ya tienes una cuenta?</p>
                            <span class="toggle-text" id="loginText">Iniciar Sesión</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: url('{{ asset('img/medical-bg.jpg') }}') no-repeat center center;
        background-size: cover;
        position: relative;
    }

    .background-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
    }

    .content-wrapper {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 1200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2rem;
    }

    .logo-section {
        text-align: center;
        margin-bottom: 2rem;
    }

    .logo {
        width: 120px;
        height: auto;
        margin-bottom: 1rem;
    }

    .system-name {
        color: white;
        font-size: 2rem;
        margin: 0;
    }

    .flip-card {
        background-color: transparent;
        width: 400px;
        height: 600px;
        perspective: 1000px;
    }

    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.8s;
        transform-style: preserve-3d;
    }

    .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .flip-card-back {
        transform: rotateY(180deg);
    }

    .form-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-bottom: 1rem;
    }

    .form-header h1 {
        color: #333;
        margin-bottom: 0.5rem;
    }

    .form-header p {
        color: #666;
        font-size: 0.9rem;
    }

    .form-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
    }

    .form-control {
        width: 100%;
        padding: 12px 40px;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
    }

    .remember-me {
        display: flex;
        align-items: center;
        margin: 1rem 0;
    }

    .login-button, .register-button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 25px;
        background: linear-gradient(45deg, #4CAF50, #45a049);
        color: white;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s;
    }

    .login-button:hover, .register-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
    }

    .form-footer {
        text-align: center;
        margin-top: 1.5rem;
    }

    .toggle-text {
        color: #4CAF50;
        cursor: pointer;
        font-weight: bold;
    }

    .toggle-text:hover {
        text-decoration: underline;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.8rem;
        margin-top: 0.25rem;
        margin-left: 1rem;
    }
    </style>

    <script>
        const flipCard = document.getElementById('flipCard');
        const registerText = document.getElementById('registerText');
        const loginText = document.getElementById('loginText');

        registerText.addEventListener('click', () => {
            flipCard.querySelector('.flip-card-inner').style.transform = 'rotateY(180deg)';
        });

        loginText.addEventListener('click', () => {
            flipCard.querySelector('.flip-card-inner').style.transform = 'rotateY(0deg)';
        });

        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
