<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nouveau mot de passe - CITINOVA</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <style>
            :root {
                --primary-color: #2E5BFF;
                --primary-dark: #1E4BD2;
                --secondary-color: #00C389;
                --dark-color: #2E384D;
                --gray-dark: #8798AD;
                --gray-medium: #BFC5D2;
                --gray-light: #F4F6FC;
                --white: #FFFFFF;
                --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            }

            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 100%);
                min-height: 100vh;
                color: var(--dark-color);
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }

            .reset-container {
                max-width: 440px;
                width: 100%;
            }

            .reset-card {
                background: var(--white);
                border-radius: 20px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                border: none;
                overflow: hidden;
            }

            .card-header {
                background: var(--gradient-primary);
                color: white;
                text-align: center;
                padding: 2.5rem 2rem;
                border-bottom: none;
            }

            .brand-logo {
                width: 50px;
                height: 50px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
            }

            .brand-logo i {
                font-size: 1.5rem;
                color: white;
            }

            .brand-name {
                font-weight: 700;
                font-size: 1.8rem;
                margin-bottom: 0.5rem;
            }

            .brand-subtitle {
                opacity: 0.9;
                font-size: 0.9rem;
            }

            .card-body {
                padding: 2.5rem;
            }

            .success-section {
                background-color: rgba(102, 187, 106, 0.1);
                border: 1px solid rgba(102, 187, 106, 0.3);
                border-radius: 12px;
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .success-icon {
                color: #66BB6A;
                margin-right: 12px;
            }

            .success-text {
                color: var(--dark-color);
                font-size: 0.95rem;
                line-height: 1.5;
                margin: 0;
            }

            .form-label {
                font-weight: 500;
                color: var(--dark-color);
                margin-bottom: 0.5rem;
                font-size: 0.9rem;
            }

            .form-control {
                border-radius: 8px;
                padding: 12px 16px;
                border: 1px solid var(--gray-medium);
                transition: all 0.3s ease;
                font-size: 0.95rem;
            }

            .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(46, 91, 255, 0.1);
            }

            .btn-primary {
                background: var(--gradient-primary);
                border: none;
                border-radius: 8px;
                padding: 12px 24px;
                font-weight: 500;
                font-size: 1rem;
                transition: all 0.3s ease;
                width: 100%;
            }

            .btn-primary:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(46, 91, 255, 0.3);
            }

            .alert {
                border-radius: 8px;
                border: none;
                font-size: 0.9rem;
            }

            .alert-danger {
                background-color: rgba(239, 83, 80, 0.1);
                color: #c62828;
                border-left: 4px solid #EF5350;
            }

            .password-toggle {
                cursor: pointer;
                background: none;
                border: none;
                color: var(--gray-dark);
                transition: color 0.3s ease;
            }

            .password-toggle:hover {
                color: var(--primary-color);
            }

            .input-group-text {
                background-color: var(--white);
                border: 1px solid var(--gray-medium);
                border-left: none;
                cursor: pointer;
            }

            .input-group .form-control:focus + .input-group-text {
                border-color: var(--primary-color);
            }

            .footer-text {
                color: var(--gray-dark);
                font-size: 0.85rem;
                margin-top: 1.5rem;
                text-align: center;
            }

            .password-strength {
                margin-top: 8px;
                font-size: 0.8rem;
                display: none;
            }

            .strength-weak { color: #EF5350; }
            .strength-medium { color: #FFA726; }
            .strength-strong { color: #66BB6A; }

            .password-match {
                margin-top: 8px;
                font-size: 0.8rem;
                display: none;
            }

            .match-valid { color: #66BB6A; }
            .match-invalid { color: #EF5350; }

            @media (max-width: 576px) {
                .card-body {
                    padding: 2rem 1.5rem;
                }
                
                .card-header {
                    padding: 2rem 1.5rem;
                }
                
                .success-section {
                    padding: 1.25rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="reset-container">
            <div class="card reset-card">
                <!-- Header -->
                <div class="card-header">
                    <div class="brand-logo">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="brand-name">CITINOVA</div>
                    <div class="brand-subtitle">Système intelligent de veille citoyenne</div>
                </div>

                <div class="card-body">
                    <h4 class="text-center mb-4" style="color: var(--dark-color);">Nouveau mot de passe</h4>

                    <!-- Success Section -->
                    <div class="success-section">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-key success-icon mt-1"></i>
                            <div>
                                <p class="success-text">
                                    Vous pouvez maintenant définir votre nouveau mot de passe. Assurez-vous qu'il est sécurisé et unique.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Erreur de réinitialisation</strong>
                            </div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email', $request->email) }}" required autofocus 
                                   autocomplete="username" placeholder="votre@email.com" readonly>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <div class="input-group">
                                <input id="password" type="password" 
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="new-password"
                                       placeholder="Saisissez votre nouveau mot de passe">
                                <button class="btn password-toggle input-group-text" type="button" id="togglePassword">
                                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="password-strength" id="passwordStrength"></div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <div class="input-group">
                                <input id="password_confirmation" type="password" 
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       name="password_confirmation" required autocomplete="new-password"
                                       placeholder="Confirmez votre nouveau mot de passe">
                                <button class="btn password-toggle input-group-text" type="button" id="toggleConfirm">
                                    <i class="fas fa-eye" id="toggleConfirmIcon"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="password-match" id="passwordMatch"></div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" id="submitButton">
                                <i class="fas fa-rotate me-2"></i>
                                Réinitialiser le mot de passe
                            </button>
                        </div>
                    </form>

                    <div class="footer-text">
                        <span>Urban Guard • Phase pilote Cotonou</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Toggle password visibility
                function setupPasswordToggle(passwordId, toggleId, iconId) {
                    const toggle = document.getElementById(toggleId);
                    const password = document.getElementById(passwordId);
                    const icon = document.getElementById(iconId);
                    
                    toggle.addEventListener('click', function() {
                        if (password.type === 'password') {
                            password.type = 'text';
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        } else {
                            password.type = 'password';
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        }
                    });
                }

                setupPasswordToggle('password', 'togglePassword', 'togglePasswordIcon');
                setupPasswordToggle('password_confirmation', 'toggleConfirm', 'toggleConfirmIcon');

                // Password strength indicator
                const passwordInput = document.getElementById('password');
                const passwordStrength = document.getElementById('passwordStrength');
                const confirmPasswordInput = document.getElementById('password_confirmation');
                const passwordMatch = document.getElementById('passwordMatch');
                const submitButton = document.getElementById('submitButton');

                if (passwordInput) {
                    passwordInput.addEventListener('input', function() {
                        const password = this.value;
                        
                        if (password.length === 0) {
                            passwordStrength.style.display = 'none';
                            return;
                        }
                        
                        let strength = 0;
                        if (password.length >= 8) strength++;
                        if (/[A-Z]/.test(password)) strength++;
                        if (/[0-9]/.test(password)) strength++;
                        if (/[^A-Za-z0-9]/.test(password)) strength++;
                        
                        const messages = ['Très faible', 'Faible', 'Moyen', 'Fort', 'Très fort'];
                        const classes = ['strength-weak', 'strength-weak', 'strength-medium', 'strength-strong', 'strength-strong'];
                        
                        passwordStrength.textContent = `Force du mot de passe : ${messages[strength]}`;
                        passwordStrength.className = `password-strength ${classes[strength]}`;
                        passwordStrength.style.display = 'block';
                    });
                }

                // Password match validation
                if (confirmPasswordInput && passwordInput) {
                    confirmPasswordInput.addEventListener('input', function() {
                        const password = passwordInput.value;
                        const confirmPassword = this.value;
                        
                        if (confirmPassword.length === 0) {
                            passwordMatch.style.display = 'none';
                            return;
                        }
                        
                        if (password === confirmPassword) {
                            passwordMatch.textContent = '✓ Les mots de passe correspondent';
                            passwordMatch.className = 'password-match match-valid';
                        } else {
                            passwordMatch.textContent = '✗ Les mots de passe ne correspondent pas';
                            passwordMatch.className = 'password-match match-invalid';
                        }
                        passwordMatch.style.display = 'block';
                    });
                }

                // Form submission animation
                const form = document.querySelector('form');
                form.addEventListener('submit', function() {
                    if (submitButton) {
                        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Réinitialisation...';
                        submitButton.disabled = true;
                    }
                });

                // Focus on password field after email (which is readonly)
                if (passwordInput) {
                    passwordInput.focus();
                }
            });
        </script>
    </body>
</html>