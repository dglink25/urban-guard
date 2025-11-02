<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vérification email - Urban Guard</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
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
            }

            body {
                background: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 100%);
                min-height: 100vh;
                font-family: 'Segoe UI', system-ui, sans-serif;
            }

            .verification-container {
                max-width: 500px;
            }

            .verification-card {
                border: none;
                border-radius: 16px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            }

            .card-header {
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
                color: white;
                border-radius: 16px 16px 0 0 !important;
                padding: 2rem;
                text-align: center;
                border: none;
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

            .card-body {
                padding: 2.5rem;
            }

            .info-section {
                background-color: rgba(33, 150, 243, 0.1);
                border: 1px solid rgba(33, 150, 243, 0.2);
                border-radius: 12px;
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
                border: none;
                border-radius: 8px;
                padding: 12px 24px;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(46, 91, 255, 0.3);
            }

            .btn-outline {
                background: transparent;
                border: 1px solid var(--gray-medium);
                border-radius: 8px;
                padding: 12px 24px;
                color: var(--gray-dark);
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .btn-outline:hover {
                background-color: var(--gray-light);
                color: var(--dark-color);
            }

            .alert-success {
                background-color: rgba(102, 187, 106, 0.1);
                border: 1px solid rgba(102, 187, 106, 0.2);
                border-radius: 8px;
                color: #2e7d32;
                border-left: 4px solid #66BB6A;
            }
        </style>
    </head>
    <body class="d-flex align-items-center justify-content-center min-vh-100 p-3">
        <div class="verification-container">
            <div class="card verification-card">
                <!-- En-tête -->
                <div class="card-header">
                    <div class="brand-logo">
                        <i class="fas fa-shield-alt fa-lg text-white"></i>
                    </div>
                    <h4 class="mb-1">URBAN GUARD</h4>
                    <p class="mb-0 opacity-75">Vérification de votre email</p>
                </div>

                <div class="card-body">
                    <!-- Message d'information -->
                    <div class="info-section">
                        <div class="d-flex">
                            <i class="fas fa-envelope-check text-primary me-3 mt-1"></i>
                            <div>
                                <p class="mb-2">
                                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Statut de session -->
                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success d-flex align-items-center mb-4">
                            <i class="fas fa-check-circle me-2"></i>
                            <div>
                                <strong>Email envoyé !</strong><br>
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="d-flex gap-3 flex-column flex-md-row">
                        <form method="POST" action="{{ route('verification.send') }}" class="flex-fill">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-paper-plane me-2"></i>
                                {{ __('Resend Verification Email') }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}" class="flex-fill">
                            @csrf
                            <button type="submit" class="btn btn-outline w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>