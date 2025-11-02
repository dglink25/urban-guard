<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Confirmation de sécurité - CITINOVA</title>

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

            .confirm-container {
                max-width: 440px;
                width: 100%;
            }

            .confirm-card {
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

            .security-section {
                background-color: rgba(255, 193, 7, 0.1);
                border: 1px solid rgba(255, 193, 7, 0.3);
                border-radius: 12px;
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .security-icon {
                color: #FF9800;
                margin-right: 12px;
            }

            .security-text {
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

            @media (max-width: 576px) {
                .card-body {
                    padding: 2rem 1.5rem;
                }
                
                .card-header {
                    padding: 2rem 1.5rem;
                }
                
                .security-section {
                    padding: 1.25rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="confirm-container">
            <div class="card confirm-card">
                <!-- Header -->
                <div class="card-header">
                    <div class="brand-logo">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="brand-name">CITINOVA</div>
                    <div class="brand-subtitle">Système intelligent de veille citoyenne</div>
                </div>

                <div class="card-body">
                    <h4 class="text-center mb-4" style="color: var(--dark-color);">Confirmation de sécurité</h4>

                    <!-- Security Section -->
                    <div class="security-section">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-shield-lock security-icon mt-1"></i>
                            <div>
                                <p class="security-text">
                                    Ceci est une zone sécurisée de l'application. Veuillez confirmer votre mot de passe avant de continuer.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Erreur de confirmation</strong>
                            </div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label">Mot de passe actuel</label>
                            <div class="input-group">
                                <input id="password" type="password" 
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password"
                                       placeholder="Saisissez votre mot de passe actuel">
                                <button class="btn password-toggle input-group-text" type="button" id="togglePassword">
                                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-shield-check me-2"></i>
                                Confirmer
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
                const togglePassword = document.getElementById('togglePassword');
                const password = document.getElementById('password');
                const togglePasswordIcon = document.getElementById('togglePasswordIcon');
                
                if (togglePassword && password) {
                    togglePassword.addEventListener('click', function() {
                        if (password.type === 'password') {
                            password.type = 'text';
                            togglePasswordIcon.classList.remove('fa-eye');
                            togglePasswordIcon.classList.add('fa-eye-slash');
                        } else {
                            password.type = 'password';
                            togglePasswordIcon.classList.remove('fa-eye-slash');
                            togglePasswordIcon.classList.add('fa-eye');
                        }
                    });
                }

                // Focus automatique sur le champ mot de passe
                if (password) {
                    password.focus();
                    
                    // Animation de focus
                    password.addEventListener('focus', function() {
                        this.parentElement.classList.add('focused');
                    });
                    
                    password.addEventListener('blur', function() {
                        this.parentElement.classList.remove('focused');
                    });
                }

                // Animation de soumission du formulaire
                const form = document.querySelector('form');
                form.addEventListener('submit', function() {
                    const submitButton = this.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Vérification...';
                        submitButton.disabled = true;
                    }
                });
            });
        </script>
    </body>
</html>