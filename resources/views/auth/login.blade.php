<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - CITINOVA</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1a5276;
            --secondary-color: #28a745;
            --accent-color: #f39c12;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {opacity: 0; transform: translateY(30px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-color), #144a6d);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .login-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color), var(--secondary-color));
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .logo {
            width: 60px;
            height: auto;
        }

        .login-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .login-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
            margin: 0;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px 12px 45px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(26, 82, 118, 0.1);
            outline: none;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .forgot-link:hover {
            color: #144a6d;
            text-decoration: underline;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), #144a6d);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 14px 20px;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(26,82,118,0.3);
        }

        .login-footer {
            text-align: center;
            padding: 20px 30px;
            border-top: 1px solid #e9ecef;
            background: #f8f9fa;
        }

        .register-link {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }

        .register-link:hover {
            color: #144a6d;
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            font-weight: 500;
        }

        .alert-success { background: rgba(40,167,69,0.1); color: #155724; border-left: 4px solid #28a745; }
        .alert-error { background: rgba(220,53,69,0.1); color: #721c24; border-left: 4px solid #dc3545; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo-container">
                <img src="{{ asset('images/CITINOVA1.png') }}" alt="Logo" class="logo">
                <div class="logo-text">
                    <h1 class="login-title">CITINOVA</h1>
                    <p class="login-subtitle">Système intelligent de veille citoyenne</p>
                </div>
            </div>
        </div>

        <div class="login-body">
            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-error">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">Adresse Email</label>
                    <div class="position-relative">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email" class="form-control" 
                               value="{{ old('email') }}" required autofocus autocomplete="email"
                               placeholder="votre@email.com">
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="position-relative">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" class="form-control" 
                               required autocomplete="current-password" placeholder="Votre mot de passe">
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember & Forgot -->
                <div class="remember-forgot">
                    <div class="form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label">Se souvenir de moi</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                    @endif
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Se connecter
                </button>
            </form>
        </div>

        <div class="login-footer">
            <p>Pas encore de compte ? 
                @if(Route::has('register'))
                    <a href="{{ route('register') }}" class="register-link">S'inscrire</a>
                @endif
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.querySelector('.password-toggle i');
            if(passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
