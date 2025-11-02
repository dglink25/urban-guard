<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Urban Guard') }}</title>

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
            }

            .urban-hero {
                background: var(--gradient-primary);
                color: white;
                border-radius: 20px;
                padding: 4rem 2rem;
                margin-bottom: 3rem;
                position: relative;
                overflow: hidden;
            }

            .urban-hero::before {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                width: 300px;
                height: 300px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                transform: translate(30%, -30%);
            }

            .urban-hero::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 200px;
                height: 200px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                transform: translate(-30%, 30%);
            }

            .hero-content {
                position: relative;
                z-index: 2;
            }

            .brand-logo {
                width: 60px;
                height: 60px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.5rem;
            }

            .brand-logo i {
                font-size: 1.8rem;
                color: white;
            }

            .feature-card {
                background: var(--white);
                border-radius: 16px;
                padding: 2rem;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                border: 1px solid var(--gray-light);
                transition: all 0.3s ease;
                height: 100%;
            }

            .feature-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            }

            .feature-icon {
                width: 60px;
                height: 60px;
                background: var(--gradient-primary);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.5rem;
            }

            .feature-icon i {
                font-size: 1.5rem;
                color: white;
            }

            .btn-urban {
                background: var(--gradient-primary);
                border: none;
                border-radius: 8px;
                padding: 12px 30px;
                font-weight: 500;
                color: white;
                transition: all 0.3s ease;
            }

            .btn-urban:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(46, 91, 255, 0.3);
                color: white;
            }

            .btn-outline-urban {
                background: transparent;
                border: 2px solid var(--primary-color);
                border-radius: 8px;
                padding: 10px 28px;
                font-weight: 500;
                color: var(--primary-color);
                transition: all 0.3s ease;
            }

            .btn-outline-urban:hover {
                background: var(--primary-color);
                color: white;
                transform: translateY(-2px);
            }

            .nav-link-custom {
                color: var(--dark-color) !important;
                font-weight: 500;
                padding: 8px 16px !important;
                border-radius: 8px;
                transition: all 0.3s ease;
                border: 1px solid transparent;
            }

            .nav-link-custom:hover {
                background: var(--gray-light);
                color: var(--primary-color) !important;
            }

            .nav-link-custom.btn-login {
                border: 1px solid var(--gray-medium);
            }

            .nav-link-custom.btn-register {
                background: var(--primary-color);
                color: white !important;
                border: 1px solid var(--primary-color);
            }

            .nav-link-custom.btn-register:hover {
                background: var(--primary-dark);
                color: white !important;
            }

            .stats-section {
                background: var(--white);
                border-radius: 16px;
                padding: 3rem 2rem;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            }

            .stat-number {
                font-size: 2.5rem;
                font-weight: 700;
                color: var(--primary-color);
                margin-bottom: 0.5rem;
            }

            .stat-label {
                color: var(--gray-dark);
                font-size: 0.9rem;
                font-weight: 500;
            }

            .footer {
                background: var(--dark-color);
                color: white;
                padding: 3rem 0;
                margin-top: 4rem;
            }

            @media (max-width: 768px) {
                .urban-hero {
                    padding: 3rem 1.5rem;
                    text-align: center;
                }
                
                .hero-buttons {
                    justify-content: center;
                }
                
                .feature-card {
                    margin-bottom: 1.5rem;
                }
            }
        </style>
    </head>
    <body>
        <!-- Header -->
        <header class="container py-4">
            @if (Route::has('login'))
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <a class="navbar-brand fw-bold fs-3 text-primary" href="{{ url('/') }}">
                            <i class="fas fa-shield-alt me-2"></i>
                            Urban Guard
                        </a>
                        
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto align-items-center gap-2">
                                @auth
                                    <li class="nav-item">
                                        <a href="{{ url('/dashboard') }}" class="nav-link-custom btn-register">
                                            <i class="fas fa-tachometer-alt me-2"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" class="nav-link-custom btn-login me-2">
                                            <i class="fas fa-sign-in-alt me-2"></i>
                                            Connexion
                                        </a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a href="{{ route('register') }}" class="nav-link-custom btn-register">
                                                <i class="fas fa-user-plus me-2"></i>
                                                S'inscrire
                                            </a>
                                        </li>
                                    @endif
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>
            @endif
        </header>

        <!-- Main Content -->
        <main class="container">
            <!-- Hero Section -->
            <section class="urban-hero text-center">
                <div class="hero-content">
                    <div class="brand-logo mx-auto">
                        <i class="fas fa-city"></i>
                    </div>
                    <h1 class="display-4 fw-bold mb-3">Urban Guard</h1>
                    <p class="lead mb-4 opacity-90 fs-5">
                        Système intelligent de veille citoyenne pour Cotonou
                    </p>
                    <p class="mb-4 opacity-80">
                        Transformez la gestion urbaine grâce à notre plateforme collaborative de signalement d'incidents en temps réel
                    </p>
                    <div class="hero-buttons d-flex gap-3 justify-content-center flex-wrap">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-light btn-lg px-4">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Accéder au Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">
                                <i class="fas fa-rocket me-2"></i>
                                Commencer maintenant
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Se connecter
                            </a>
                        @endauth
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Signalement en temps réel</h4>
                        <p class="text-muted">
                            Signalez rapidement les incidents urbains avec géolocalisation automatique et photos
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto">
                            <i class="fas fa-map"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Carte interactive</h4>
                        <p class="text-muted">
                            Visualisez tous les incidents sur une carte dynamique avec filtres par type et statut
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Tableau de bord</h4>
                        <p class="text-muted">
                            Suivez les statistiques et gérez les incidents grâce à un dashboard complet
                        </p>
                    </div>
                </div>
            </section>

            <!-- Stats Section -->
            <section class="stats-section text-center mb-5">
                <div class="row g-4">
                    <div class="col-md-3 col-6">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Signalements traités</div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-number">24h/24</div>
                        <div class="stat-label">Disponibilité</div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Quartiers couverts</div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Satisfaction</div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="text-center py-5">
                <h2 class="fw-bold mb-3">Prêt à transformer Cotonou ?</h2>
                <p class="text-muted mb-4 lead">
                    Rejoignez la communauté Urban Guard et contribuez à améliorer votre ville
                </p>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-urban btn-lg">
                        <i class="fas fa-play-circle me-2"></i>
                        Commencer à utiliser
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-urban btn-lg me-3">
                        <i class="fas fa-user-plus me-2"></i>
                        Créer un compte
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-urban btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Se connecter
                    </a>
                @endauth
            </section>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-3">
                            <i class="fas fa-shield-alt me-2"></i>
                            Urban Guard
                        </h5>
                        <p class="mb-0 opacity-75">
                            Système intelligent de veille citoyenne - Phase pilote Cotonou
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0 opacity-75">
                            &copy; {{ date('Y') }} Urban Guard. Tous droits réservés.
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>