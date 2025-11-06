<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'CitiNova') }} - Administration</title>

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
                --gradient-authority: linear-gradient(135deg, #1a237e 0%, #283593 50%, #3949ab 100%);
            }

            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, var(--gray-light) 0%, var(--white) 100%);
                min-height: 100vh;
                color: var(--dark-color);
            }

            .authority-hero {
                background: var(--gradient-authority);
                color: white;
                border-radius: 20px;
                padding: 4rem 2rem;
                margin-bottom: 3rem;
                position: relative;
                overflow: hidden;
            }

            .authority-hero::before {
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

            .authority-hero::after {
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
                background: var(--gradient-authority);
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

            .btn-authority {
                background: var(--gradient-authority);
                border: none;
                border-radius: 8px;
                padding: 12px 30px;
                font-weight: 500;
                color: white;
                transition: all 0.3s ease;
            }

            .btn-authority:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(26, 35, 126, 0.4);
                color: white;
            }

            .btn-outline-authority {
                background: transparent;
                border: 2px solid #1a237e;
                border-radius: 8px;
                padding: 10px 28px;
                font-weight: 500;
                color: #1a237e;
                transition: all 0.3s ease;
            }

            .btn-outline-authority:hover {
                background: #1a237e;
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
                color: #1a237e !important;
            }

            .nav-link-custom.btn-login {
                border: 1px solid var(--gray-medium);
            }

            .nav-link-custom.btn-register {
                background: var(--gradient-authority);
                color: white !important;
                border: 1px solid #1a237e;
            }

            .nav-link-custom.btn-register:hover {
                background: #0d184e;
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
                color: #1a237e;
                margin-bottom: 0.5rem;
            }

            .stat-label {
                color: var(--gray-dark);
                font-size: 0.9rem;
                font-weight: 500;
            }

            .dashboard-card {
                background: var(--white);
                border-radius: 16px;
                padding: 1.5rem;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                border: 1px solid var(--gray-light);
                transition: all 0.3s ease;
                height: 100%;
            }

            .dashboard-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
            }

            .dashboard-icon {
                width: 50px;
                height: 50px;
                background: var(--gradient-authority);
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1rem;
            }

            .dashboard-icon i {
                font-size: 1.3rem;
                color: white;
            }

            .priority-badge {
                background: #ff5252;
                color: white;
                padding: 4px 10px;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: 600;
            }

            .footer {
                background: var(--dark-color);
                color: white;
                padding: 3rem 0;
                margin-top: 4rem;
            }

            .alert-item {
                border-left: 4px solid #ff5252;
                padding-left: 1rem;
                margin-bottom: 1rem;
            }

            .alert-item.medium {
                border-left-color: #ff9800;
            }

            .alert-item.low {
                border-left-color: #4caf50;
            }

            @media (max-width: 768px) {
                .authority-hero {
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
                        <a class="navbar-brand fw-bold fs-3" href="{{ url('/') }}" style="color: #1a237e;">
                            <i class="fas fa-landmark me-2"></i>
                            CITINOVA <span class="badge bg-light text-dark ms-2">Administration</span>
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
                                            Tableau de bord
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
            <section class="authority-hero">
                <div class="hero-content">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="brand-logo d-inline-flex">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <h1 class="display-5 fw-bold mb-3">Portail d'Administration CITINOVA</h1>
                            <p class="lead mb-4 opacity-90">
                                Système de veille citoyenne pour les autorités locales. Supervisez, analysez et réagissez aux alertes citoyennes en temps réel.
                            </p>
                            <div class="hero-buttons d-flex gap-3">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-authority btn-lg">
                                        <i class="fas fa-tachometer-alt me-2"></i>
                                        Accéder au tableau de bord
                                    </a>
                                @else
                                    <a href="{{ route('register') }}" class="btn btn-authority btn-lg">
                                        <i class="fas fa-user-shield me-2"></i>
                                        Créer un compte autorité
                                    </a>
                                    <a href="{{ route('login') }}" class="btn btn-outline-authority btn-lg">
                                        <i class="fas fa-sign-in-alt me-2"></i>
                                        Se connecter
                                    </a>
                                @endauth
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <i class="fas fa-user-tie display-1 opacity-75"></i>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Quick Stats Section -->
            <section class="stats-section mb-5">
                <div class="row text-center">
                    <div class="col-md-3 mb-4">
                        <div class="stat-number">1,247</div>
                        <div class="stat-label">Alertes traitées ce mois</div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="stat-number">94%</div>
                        <div class="stat-label">Taux de résolution</div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="stat-number">32</div>
                        <div class="stat-label">Jours sans incident majeur</div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="stat-number">18</div>
                        <div class="stat-label">Départements actifs</div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section class="mb-5">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="fw-bold mb-3">Fonctionnalités dédiées aux autorités</h2>
                        <p class="text-muted">Des outils puissants pour une gestion efficace de la veille citoyenne</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Tableaux de bord analytiques</h4>
                            <p class="text-muted">
                                Visualisez les données d'alertes par zone, type et priorité. Suivez les indicateurs de performance de vos services.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Alertes en temps réel</h4>
                            <p class="text-muted">
                                Recevez des notifications instantanées pour les alertes prioritaires et coordonnez les interventions rapidement.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-users-cog"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Gestion des équipes</h4>
                            <p class="text-muted">
                                Affectez des alertes aux services compétents et suivez l'avancement des interventions en temps réel.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Cartographie interactive</h4>
                            <p class="text-muted">
                                Visualisez géographiquement les alertes et identifiez les zones à problèmes sur une carte détaillée.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Rapports automatisés</h4>
                            <p class="text-muted">
                                Générez des rapports détaillés pour les instances décisionnelles et les communications officielles.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Sécurité renforcée</h4>
                            <p class="text-muted">
                                Accès sécurisé avec authentification à deux facteurs et gestion des permissions par niveau hiérarchique.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Dashboard Preview -->
            <section class="mb-5">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2 class="fw-bold mb-3">Aperçu du tableau de bord</h2>
                        <p class="text-muted">Interface de gestion complète pour les autorités locales</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="dashboard-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="dashboard-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <span class="priority-badge">HAUTE PRIORITÉ</span>
                            </div>
                            <h4 class="fw-bold mb-3">Alertes urgentes</h4>
                            <div class="alert-item">
                                <h6 class="fw-bold mb-1">Route barrée - Inondation</h6>
                                <p class="mb-1 text-muted">Arrondissement de Cadjehoun</p>
                                <small class="text-muted">Il y a 15 minutes</small>
                            </div>
                            <div class="alert-item medium">
                                <h6 class="fw-bold mb-1">Décharge sauvage</h6>
                                <p class="mb-1 text-muted">Quartier Saint Michel</p>
                                <small class="text-muted">Il y a 2 heures</small>
                            </div>
                            <div class="alert-item low">
                                <h6 class="fw-bold mb-1">Éclairage public défaillant</h6>
                                <p class="mb-1 text-muted">Avenue Steinmetz</p>
                                <small class="text-muted">Il y a 5 heures</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dashboard-card">
                            <div class="dashboard-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Interventions en cours</h4>
                            <div class="progress mb-3" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mb-3">75% des alertes en cours de traitement</p>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Équipe Voirie</span>
                                <span class="fw-bold">12/15</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Équipe Salubrité</span>
                                <span class="fw-bold">8/10</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Équipe Éclairage</span>
                                <span class="fw-bold">5/8</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="text-center py-5">
                <h2 class="fw-bold mb-3">Prêt à superviser la veille citoyenne ?</h2>
                <p class="text-muted mb-4 lead">
                    Rejoignez le portail d'administration CITINOVA et optimisez la gestion des alertes citoyennes
                </p>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-authority btn-lg">
                        <i class="fas fa-play-circle me-2"></i>
                        Accéder au tableau de bord
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-authority btn-lg me-3">
                        <i class="fas fa-user-shield me-2"></i>
                        Créer un compte autorité
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-authority btn-lg">
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
                            <i class="fas fa-landmark me-2"></i>
                            CITINOVA <span class="badge bg-light text-dark ms-1">Administration</span>
                        </h5>
                        <p class="mb-0 opacity-75">
                            Système intelligent de veille citoyenne - Portail d'administration pour autorités locales
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0 opacity-75">
                            &copy; {{ date('Y') }} CITINOVA. Tous droits réservés.
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>