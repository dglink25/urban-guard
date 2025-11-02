<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mot de passe oublié - CITINOVA</title>

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

            .info-section {
                background-color: rgba(33, 150, 243, 0.1);
                border: 1px solid rgba(33, 150, 243, 0.3);
                border-radius: 12px;
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .info-icon {
                color: var(--primary-color);
                margin-right: 12px;
            }

            .info-text {
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

            .alert-success {
                background-color: rgba(102, 187, 106, 0.1);
                color: #2e7d32;
                border-left: 4px solid #66BB6A;
            }

            .alert-danger {
                background-color: rgba(239, 83, 80, 0.1);
                color: #c62828;
                border-left: 4px solid #EF5350;
            }

            .link-primary {
                color: var(--primary-color);
                text-decoration: none;
                font-weight: 500;
                transition: color 0.3s ease;
            }

            .link-primary:hover {
                color: var(--primary-dark);
            }

            .footer-text {
                color: var(--gray-dark);
                font-size: 0.85rem;
                margin-top: 1.5rem;
                text-align: center;
            }

            .back-link {
                color: var(--gray-dark);
                text-decoration: none;
                font-size: 0.9rem;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                transition: color 0.3s ease;
                margin-top: 1rem;
            }

            .back-link:hover {
                color: var(--primary-color);
            }

            @media (max-width: 576px) {
                .card-body {
                    padding: 2rem 1.5rem;
                }
                
                .card-header {
                    padding: 2rem 1.5rem;
                }
                
                .info-section {
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
                    <h4 class="text-center mb-4" style="color: var(--dark-color);">Réinitialisation du mot de passe</h4>

                    <!-- Information Section -->
                    <div class="info-section">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-key info-icon mt-1"></i>
                            <div>
                                <p class="info-text">
                                    Mot de passe oublié ? Aucun problème. Indiquez-nous votre adresse email et nous vous enverrons un lien de réinitialisation.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>Email envoyé !</strong>
                            </div>
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Erreur d'envoi</strong>
                            </div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-4">
                            <label for="email" class="form-label">Adresse email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autofocus 
                                   placeholder="votre@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>
                                Envoyer le lien de réinitialisation
                            </button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="back-link">
                                <i class="fas fa-arrow-left me-1"></i>
                                Retour à la connexion
                            </a>
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
                // Ajouter des animations de focus
                const emailInput = document.getElementById('email');
                
                if (emailInput) {
                    emailInput.addEventListener('focus', function() {
                        this.parentElement.classList.add('focused');
                    });
                    
                    emailInput.addEventListener('blur', function() {
                        this.parentElement.classList.remove('focused');
                    });

                    // Focus automatique sur le champ email
                    emailInput.focus();
                }

                // Animation de soumission du formulaire
                const form = document.querySelector('form');
                form.addEventListener('submit', function() {
                    const submitButton = this.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Envoi en cours...';
                        submitButton.disabled = true;
                    }
                });
            });
        </script>
    </body>
</html>