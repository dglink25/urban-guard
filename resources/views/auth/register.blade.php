<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inscription - CITINOVA</title>

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

            .register-container {
                max-width: 800px;
                width: 100%;
            }

            .register-card {
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

            .form-label {
                font-weight: 500;
                color: var(--dark-color);
                margin-bottom: 0.5rem;
                font-size: 0.9rem;
            }

            .form-control, .form-select {
                border-radius: 8px;
                padding: 12px 16px;
                border: 1px solid var(--gray-medium);
                transition: all 0.3s ease;
                font-size: 0.95rem;
            }

            .form-control:focus, .form-select:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(46, 91, 255, 0.1);
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

            .btn-primary {
                background: var(--gradient-primary);
                border: none;
                border-radius: 8px;
                padding: 12px 30px;
                font-weight: 500;
                font-size: 1rem;
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(46, 91, 255, 0.3);
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

            .input-group-text {
                background-color: var(--white);
                border: 1px solid var(--gray-medium);
                border-left: none;
                cursor: pointer;
            }

            .input-group .form-control:focus + .input-group-text {
                border-color: var(--primary-color);
            }

            .section-title {
                font-size: 1.1rem;
                font-weight: 600;
                color: var(--dark-color);
                margin-bottom: 1rem;
                padding-bottom: 0.5rem;
                border-bottom: 2px solid var(--gray-light);
            }

            .loading-spinner {
                display: none;
                width: 16px;
                height: 16px;
                border: 2px solid #f3f3f3;
                border-top: 2px solid var(--primary-color);
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            @media (max-width: 768px) {
                .card-body {
                    padding: 2rem 1.5rem;
                }
                
                .card-header {
                    padding: 2rem 1.5rem;
                }
                
                .register-container {
                    max-width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <div class="register-container">
            <div class="card register-card">
                <!-- Header -->
                <div class="card-header">
                    <div class="brand-logo">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="brand-name">CITINOVA</div>
                    <div class="brand-subtitle">Système intelligent de veille citoyenne</div>
                </div>

                <div class="card-body">
                    <h4 class="text-center mb-4" style="color: var(--dark-color);">Créer votre compte</h4>

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Erreurs de validation</strong>
                            </div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Informations personnelles -->
                        <div class="section-title">
                            <i class="fas fa-user me-2"></i>
                            Informations personnelles
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nom complet</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" required autofocus 
                                       autocomplete="name" placeholder="Votre nom complet">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Adresse email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required 
                                       autocomplete="username" placeholder="votre@email.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Localisation -->
                        <div class="section-title mt-4">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Localisation
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Département</label>
                                <select id="departement-select" name="id_departement" required
                                        class="form-select @error('id_departement') is-invalid @enderror">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach($departements as $departement)
                                        <option value="{{ $departement->id }}" {{ old('id_departement') == $departement->id ? 'selected' : '' }}>
                                            {{ $departement->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_departement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Commune</label>
                                <select id="commune-select" name="id_commune" required
                                        class="form-select @error('id_commune') is-invalid @enderror">
                                    <option value="">-- Sélectionner un département --</option>
                                </select>
                                @error('id_commune')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Arrondissement</label>
                                <select id="arrondissement-select" name="id_arrondissement" required
                                        class="form-select @error('id_arrondissement') is-invalid @enderror">
                                    <option value="">-- Sélectionner une commune --</option>
                                </select>
                                @error('id_arrondissement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quartier</label>
                                <select id="quartier-select" name="id_quartier" required
                                        class="form-select @error('id_quartier') is-invalid @enderror">
                                    <option value="">-- Sélectionner un arrondissement --</option>
                                </select>
                                @error('id_quartier')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rue</label>
                                <input type="text" name="rue" value="{{ old('rue') }}" required
                                       class="form-control @error('rue') is-invalid @enderror"
                                       placeholder="Nom de la rue">
                                @error('rue')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Maison</label>
                                <input type="text" name="maison" value="{{ old('maison') }}" required
                                       class="form-control @error('maison') is-invalid @enderror"
                                       placeholder="Numéro de maison">
                                @error('maison')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Rôle -->
                        <div class="section-title mt-4">
                            <i class="fas fa-user-tag me-2"></i>
                            Rôle dans l'administration
                        </div>

                        <div class="mb-4">
                            <select name="role" required class="form-select @error('role') is-invalid @enderror">
                                <option value="">-- Sélectionner votre rôle --</option>
                                <option value="prefet" {{ old('role') == 'prefet' ? 'selected' : '' }}>Préfet</option>
                                <option value="maire" {{ old('role') == 'maire' ? 'selected' : '' }}>Maire</option>
                                <option value="ca" {{ old('role') == 'ca' ? 'selected' : '' }}>Chef d'Arrondissement</option>
                                <option value="cq" {{ old('role') == 'cq' ? 'selected' : '' }}>Chef de Quartier</option>
                                <option value="conseiller" {{ old('role') == 'conseiller' ? 'selected' : '' }}>Conseiller</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sécurité -->
                        <div class="section-title mt-4">
                            <i class="fas fa-lock me-2"></i>
                            Sécurité du compte
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <div class="input-group">
                                    <input id="password" type="password" 
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="new-password"
                                           placeholder="Votre mot de passe">
                                    <button class="btn password-toggle input-group-text" type="button" id="togglePassword">
                                        <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                <div class="input-group">
                                    <input id="password_confirmation" type="password" 
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           name="password_confirmation" required autocomplete="new-password"
                                           placeholder="Confirmer le mot de passe">
                                    <button class="btn password-toggle input-group-text" type="button" id="toggleConfirm">
                                        <i class="fas fa-eye" id="toggleConfirmIcon"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <a href="{{ route('login') }}" class="link-primary">
                                <i class="fas fa-arrow-left me-1"></i>
                                Déjà inscrit ?
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-user-plus me-2"></i>
                                Créer mon compte
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
            document.addEventListener('DOMContentLoaded', () => {
                const departementSelect = document.getElementById('departement-select');
                const communeSelect = document.getElementById('commune-select');
                const arrondissementSelect = document.getElementById('arrondissement-select');
                const quartierSelect = document.getElementById('quartier-select');

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

                // Charger les communes selon le département
                departementSelect.addEventListener('change', async () => {
                    const id = departementSelect.value;
                    communeSelect.innerHTML = '<option value="">Chargement...</option>';
                    arrondissementSelect.innerHTML = '<option value="">-- Sélectionner une commune --</option>';
                    quartierSelect.innerHTML = '<option value="">-- Sélectionner un arrondissement --</option>';

                    if (!id) {
                        communeSelect.innerHTML = '<option value="">-- Sélectionner un département --</option>';
                        return;
                    }

                    try {
                        const response = await fetch(`/api/communes/${id}`);
                        const data = await response.json();
                        communeSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                        data.forEach(c => {
                            communeSelect.innerHTML += `<option value="${c.id}">${c.name}</option>`;
                        });
                    } catch (error) {
                        communeSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                        console.error('Erreur:', error);
                    }
                });

                // Charger les arrondissements selon la commune
                communeSelect.addEventListener('change', async () => {
                    const id = communeSelect.value;
                    arrondissementSelect.innerHTML = '<option value="">Chargement...</option>';
                    quartierSelect.innerHTML = '<option value="">-- Sélectionner un arrondissement --</option>';

                    if (!id) {
                        arrondissementSelect.innerHTML = '<option value="">-- Sélectionner une commune --</option>';
                        return;
                    }

                    try {
                        const response = await fetch(`/api/arrondissements/${id}`);
                        const data = await response.json();
                        arrondissementSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                        data.forEach(a => {
                            arrondissementSelect.innerHTML += `<option value="${a.id}">${a.name}</option>`;
                        });
                    } catch (error) {
                        arrondissementSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                        console.error('Erreur:', error);
                    }
                });

                // Charger les quartiers selon l'arrondissement
                arrondissementSelect.addEventListener('change', async () => {
                    const id = arrondissementSelect.value;
                    quartierSelect.innerHTML = '<option value="">Chargement...</option>';

                    if (!id) {
                        quartierSelect.innerHTML = '<option value="">-- Sélectionner un arrondissement --</option>';
                        return;
                    }

                    try {
                        const response = await fetch(`/api/quartiers/${id}`);
                        const data = await response.json();
                        quartierSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                        data.forEach(q => {
                            quartierSelect.innerHTML += `<option value="${q.id}">${q.name}</option>`;
                        });
                    } catch (error) {
                        quartierSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                        console.error('Erreur:', error);
                    }
                });
            });
        </script>
    </body>
</html>