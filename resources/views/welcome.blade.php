@include('layouts.navigation')
@php
    $departements = $departements ?? \App\Models\Departement::orderBy('name')->get();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'CITINOVA') }} - Gestion des Infrastructures Territoriales</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
    :root {
        --primary-color: #1a5276;
        --secondary-color: #28a745;
        --accent-color: #f39c12;
        --light-bg: #FDFDFC;
        --dark-bg: #0a0a0a;
        --text-dark: #1b1b18;
        --text-light: #EDEDEC;
    }
    
    body {
        font-family: 'Instrument Sans', sans-serif;
        background-color: var(--light-bg);
        color: var(--text-dark);
        overflow-x: hidden;
        scroll-behavior: smooth;
    }
    
    /* Navigation améliorée */
    .navbar {
        background-color: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        padding: 12px 0;
    }
    
    .navbar-brand {
        font-weight: 700;
        font-size: 1.8rem;
        color: var(--primary-color) !important;
        display: flex;
        align-items: center;
    }
    
    .nav-link {
        font-weight: 500;
        color: var(--text-dark) !important;
        padding: 8px 16px !important;
        border-radius: 20px;
        transition: all 0.3s ease;
    }
    
    .nav-link:hover {
        color: var(--primary-color) !important;
        background-color: rgba(26, 82, 118, 0.05);
    }
    
    .nav-link.active {
        color: white !important;
        background: linear-gradient(135deg, var(--primary-color), #144a6d);
    }
    
    .btn-citinova {
        background: linear-gradient(135deg, var(--primary-color), #144a6d);
        color: white;
        padding: 10px 25px;
        border-radius: 30px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-citinova:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(26, 82, 118, 0.4);
        color: white;
    }
    
    /* Section Hero */
    .hero-section {
        background: linear-gradient(135deg, #1a5276 0%, #144a6d 100%);
        color: white;
        padding: 120px 0 80px;
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }
    
    .hero-stats {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        margin-top: 3rem;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--accent-color);
    }
    
    .stat-label {
        font-size: 0.9rem;
        opacity: 0.8;
    }
    
    /* Sections générales */
    .section-title {
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }
    
    .section-subtitle {
        color: #666;
        font-size: 1.1rem;
        margin-bottom: 3rem;
    }
    
    .card-infrastructure {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        height: 100%;
    }
    
    .card-infrastructure:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .infrastructure-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color), #144a6d);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    
    .infrastructure-icon i {
        font-size: 2rem;
        color: white;
    }
    
    /* Section Carte Interactive */
    .map-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 100px 0;
    }
    
    .benin-map {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .department-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .department-card:hover {
        transform: translateX(10px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .department-stats {
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-value {
        font-weight: 700;
        color: var(--primary-color);
        font-size: 1.2rem;
    }
    
    .stat-label {
        font-size: 0.8rem;
        color: #666;
    }
    
    /* Section Fonctionnalités */
    .feature-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        height: 100%;
        transition: all 0.3s ease;
        border: 1px solid #eee;
    }
    
    .feature-card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
    }
    
    .feature-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--accent-color), #e67e22);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    
    .feature-icon i {
        font-size: 1.5rem;
        color: white;
    }
    
    /* Footer */
    .footer {
        background: linear-gradient(135deg, var(--primary-color) 0%, #144a6d 100%);
        color: white;
        padding: 60px 0 30px;
    }
    
    .footer-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    
    .footer-links {
        list-style: none;
        padding: 0;
    }
    
    .footer-links li {
        margin-bottom: 0.8rem;
    }
    
    .footer-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .footer-links a:hover {
        color: white;
        padding-left: 5px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
        }
        
        .department-card:hover {
            transform: none;
        }
    }
    </style>
</head>
<body>
    <!-- Section Hero -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title animate__animated animate__fadeInUp">
                        CITINOVA - Gestion Intelligente des Infrastructures Territoriales
                    </h1>
                    <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
                        Plateforme centralisée pour la gestion, le suivi et l'optimisation des infrastructures publiques au Bénin
                    </p>
                    <div class="animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="#infrastructures" class="btn btn-citinova me-3">
                            <i class="fas fa-map-marked-alt me-2"></i>Explorer la Carte
                        </a>
                        <a href="#a-propos" class="btn btn-outline-light">
                            <i class="fas fa-info-circle me-2"></i>En savoir plus
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center animate__animated animate__fadeInRight">
                        <img src="https://images.unsplash.com/photo-1583324113626-70df0f4deaab?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Infrastructures urbaines" class="img-fluid rounded-3 shadow-lg">
                    </div>
                </div>
            </div>
            
            <!-- Statistiques -->
            <div class="row hero-stats animate__animated animate__fadeInUp animate__delay-3s">
                <div class="col-md-3 col-6 text-center">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Départements</div>
                </div>
                <div class="col-md-3 col-6 text-center">
                    <div class="stat-number">2,156</div>
                    <div class="stat-label">Km de Routes</div>
                </div>
                <div class="col-md-3 col-6 text-center">
                    <div class="stat-number">15,842</div>
                    <div class="stat-label">Points Lumineux</div>
                </div>
                <div class="col-md-3 col-6 text-center">
                    <div class="stat-number">327</div>
                    <div class="stat-label">Projets Actifs</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Infrastructures -->
    <section id="infrastructures" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Types d'Infrastructures Gérées</h2>
                <p class="section-subtitle">Découvrez les différentes catégories d'infrastructures que nous suivons et optimisons</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card-infrastructure shadow-sm">
                        <div class="card-body text-center p-5">
                            <div class="infrastructure-icon">
                                <i class="fas fa-road"></i>
                            </div>
                            <h4>Réseau Routier</h4>
                            <p class="text-muted">
                                Suivi complet des infrastructures routières : état, maintenance, interventions et projets d'amélioration
                            </p>
                            <div class="mt-4">
                                <span class="badge bg-primary me-2">2,156 km suivis</span>
                                <span class="badge bg-success">87% en bon état</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card-infrastructure shadow-sm">
                        <div class="card-body text-center p-5">
                            <div class="infrastructure-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h4>Éclairage Public</h4>
                            <p class="text-muted">
                                Gestion intelligente de l'éclairage public : maintenance préventive, signalement de pannes, optimisation énergétique
                            </p>
                            <div class="mt-4">
                                <span class="badge bg-primary me-2">15,842 points</span>
                                <span class="badge bg-success">92% opérationnels</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Carte Interactive -->
    <section id="carte" class="map-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Carte Interactive des Infrastructures</h2>
                <p class="section-subtitle">Visualisez en temps réel l'état des infrastructures sur l'ensemble du territoire</p>
            </div>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="benin-map">
                        <!-- Carte du Bénin avec zones interactives -->
                        <div class="text-center p-5 bg-light rounded-3">
                            <h5>Carte Interactive du Bénin</h5>
                            <p class="text-muted">Visualisation des infrastructures par département</p>
                            <div class="mt-4">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/6/6f/Benin_%28orthographic_projection%29.svg" 
                                     alt="Carte du Bénin" class="img-fluid" style="max-height: 400px;">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <h5 class="mb-4">Départements</h5>
                    
                    <!-- Liste des départements avec statistiques -->
                    @foreach($departements->take(5) as $departement)
                    <div class="department-card">
                        <h6>{{ $departement->name }}</h6>
                        <div class="department-stats">
                            <div class="stat-item">
                                <div class="stat-value">156</div>
                                <div class="stat-label">Routes</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">1,284</div>
                                <div class="stat-label">Éclairages</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">24</div>
                                <div class="stat-label">Projets</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="text-center mt-4">
                        <a href="#" class="btn btn-outline-primary">
                            Voir tous les départements
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Fonctionnalités -->
    <section id="fonctionnalites" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Fonctionnalités Principales</h2>
                <p class="section-subtitle">Découvrez les outils puissants de notre plateforme</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h5>Cartographie en Temps Réel</h5>
                        <p class="text-muted">
                            Visualisation interactive de l'état de toutes les infrastructures avec mise à jour en temps réel
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h5>Gestion de Maintenance</h5>
                        <p class="text-muted">
                            Planification et suivi des opérations de maintenance préventive et corrective
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h5>Analytics & Reporting</h5>
                        <p class="text-muted">
                            Tableaux de bord complets avec indicateurs de performance et rapports détaillés
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="footer-title">CITINOVA</h5>
                    <p class="text-light">
                        Plateforme innovante de gestion des infrastructures territoriales pour un Bénin mieux connecté et développé.
                    </p>
                </div>
                
                <div class="col-lg-2 col-6 mb-4">
                    <h6 class="footer-title">Navigation</h6>
                    <ul class="footer-links">
                        <li><a href="#accueil">Accueil</a></li>
                        <li><a href="#infrastructures">Infrastructures</a></li>
                        <li><a href="#carte">Carte Interactive</a></li>
                        <li><a href="#fonctionnalites">Fonctionnalités</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-6 mb-4">
                    <h6 class="footer-title">Infrastructures</h6>
                    <ul class="footer-links">
                        <li><a href="#">Réseau Routier</a></li>
                        <li><a href="#">Éclairage Public</a></li>
                        <li><a href="#">Ouvrages d'Art</a></li>
                        <li><a href="#">Équipements Publics</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 mb-4">
                    <h6 class="footer-title">Contact</h6>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Cotonou, Bénin</li>
                        <li><i class="fas fa-phone me-2"></i> +229 XX XX XX XX</li>
                        <li><i class="fas fa-envelope me-2"></i> contact@citinova.bj</li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
            
            <div class="text-center">
                <p class="mb-0">&copy; 2024 CITINOVA - Tous droits réservés</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Animation au défilement
        document.addEventListener('DOMContentLoaded', function() {
            // Ajouter la classe animate__animated aux éléments au scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__fadeInUp');
                    }
                });
            });
            
            document.querySelectorAll('.card-infrastructure, .feature-card, .department-card').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
</body>
</html>