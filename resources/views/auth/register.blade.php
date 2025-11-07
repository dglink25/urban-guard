<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - CITINOVA</title>

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

        .register-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 600px;
            overflow: hidden;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {opacity: 0; transform: translateY(30px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .register-header {
            background: linear-gradient(135deg, var(--primary-color), #144a6d);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .register-header::after {
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

        .register-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .register-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
            margin: 0;
        }

        .register-body {
            padding: 40px 30px;
        }

        .section-title {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 5px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e9ecef;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
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

        .btn-register {
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

        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(26,82,118,0.3);
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

        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 0.85rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <div class="logo-container">
                <img src="{{ asset('images/CITINOVA1.png') }}" alt="Logo" class="logo">
                <div>
                    <h1 class="register-title">CITINOVA</h1>
                    <p class="register-subtitle">Système intelligent de veille citoyenne</p>
                </div>
            </div>
        </div>

        <div class="register-body">
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

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Informations personnelles -->
                <div class="section-title">Informations personnelles</div>

                <div class="form-group">
                    <label for="name" class="form-label">Nom complet</label>
                    <i class="fas fa-user input-icon"></i>
                    <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Votre nom complet">
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Adresse email</label>
                    <i class="fas fa-envelope input-icon"></i>
                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="votre@email.com">
                </div>

                <!-- Localisation -->
                <div class="section-title mt-4">Localisation</div>

                <div class="form-group">
                    <label for="departement" class="form-label">Département</label>
                    <i class="fas fa-map-marker-alt input-icon"></i>
                    <select id="departement-select" name="id_departement" class="form-select" required>
                        <option value="">-- Sélectionner --</option>
                        @foreach($departements as $departement)
                            <option value="{{ $departement->id }}" {{ old('id_departement') == $departement->id ? 'selected' : '' }}>{{ $departement->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="commune" class="form-label">Commune</label>
                    <i class="fas fa-map-marker-alt input-icon"></i>
                    <select id="commune-select" name="id_commune" class="form-select" required>
                        <option value="">-- Sélectionner un département --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="arrondissement" class="form-label">Arrondissement</label>
                    <i class="fas fa-map-marker-alt input-icon"></i>
                    <select id="arrondissement-select" name="id_arrondissement" class="form-select" required>
                        <option value="">-- Sélectionner une commune --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="quartier" class="form-label">Quartier</label>
                    <i class="fas fa-map-marker-alt input-icon"></i>
                    <select id="quartier-select" name="id_quartier" class="form-select" required>
                        <option value="">-- Sélectionner un arrondissement --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="rue" class="form-label">Rue</label>
                    <i class="fas fa-road input-icon"></i>
                    <input type="text" name="rue" class="form-control" value="{{ old('rue') }}" placeholder="Nom de la rue" required>
                </div>

                <div class="form-group">
                    <label for="maison" class="form-label">Maison</label>
                    <i class="fas fa-home input-icon"></i>
                    <input type="text" name="maison" class="form-control" value="{{ old('maison') }}" placeholder="Numéro de maison" required>
                </div>

                <!-- Rôle -->
                <div class="section-title mt-4">Rôle dans l'administration</div>

                <div class="form-group">
                    <i class="fas fa-user-tag input-icon"></i>
                    <select name="role" class="form-select" required>
                        <option value="">-- Sélectionner votre rôle --</option>
                        <option value="prefet" {{ old('role')=='prefet'?'selected':'' }}>Préfet</option>
                        <option value="maire" {{ old('role')=='maire'?'selected':'' }}>Maire</option>
                        <option value="ca" {{ old('role')=='ca'?'selected':'' }}>Chef d'Arrondissement</option>
                        <option value="cq" {{ old('role')=='cq'?'selected':'' }}>Chef de Quartier</option>
                        <option value="conseiller" {{ old('role')=='conseiller'?'selected':'' }}>Conseiller</option>
                    </select>
                </div>

                <!-- Sécurité -->
                <div class="section-title mt-4">Sécurité du compte</div>

                <div class="form-group position-relative">
                    <label for="password" class="form-label">Mot de passe</label>
                    <i class="fas fa-lock input-icon"></i>
                    <input id="password" type="password" name="password" class="form-control" required placeholder="Votre mot de passe">
                    <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <div class="form-group position-relative">
                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                    <i class="fas fa-lock input-icon"></i>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required placeholder="Confirmer le mot de passe">
                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <button type="submit" class="btn-register mt-3">
                    <i class="fas fa-user-plus me-2"></i> Créer mon compte
                </button>

                <div class="footer-text mt-3">
                    <a href="{{ route('login') }}" class="link-primary">Déjà inscrit ? Connectez-vous</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            const icon = btn.querySelector('i');
            if(input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const departementSelect = document.getElementById('departement-select');
            const communeSelect = document.getElementById('commune-select');
            const arrondissementSelect = document.getElementById('arrondissement-select');
            const quartierSelect = document.getElementById('quartier-select');

            departementSelect.addEventListener('change', async () => {
                const id = departementSelect.value;
                communeSelect.innerHTML = '<option>Chargement...</option>';
                arrondissementSelect.innerHTML = '<option>-- Sélectionner une commune --</option>';
                quartierSelect.innerHTML = '<option>-- Sélectionner un arrondissement --</option>';

                if(!id) { communeSelect.innerHTML='<option>-- Sélectionner un département --</option>'; return; }

                try {
                    const res = await fetch(`/api/communes/${id}`);
                    const data = await res.json();
                    communeSelect.innerHTML='<option value="">-- Sélectionner --</option>';
                    data.forEach(c => communeSelect.innerHTML += `<option value="${c.id}">${c.name}</option>`);
                } catch(e) { communeSelect.innerHTML='<option>Erreur de chargement</option>'; }
            });

            communeSelect.addEventListener('change', async () => {
                const id = communeSelect.value;
                arrondissementSelect.innerHTML='<option>Chargement...</option>';
                quartierSelect.innerHTML='<option>-- Sélectionner un arrondissement --</option>';
                if(!id) { arrondissementSelect.innerHTML='<option>-- Sélectionner une commune --</option>'; return; }

                try {
                    const res = await fetch(`/api/arrondissements/${id}`);
                    const data = await res.json();
                    arrondissementSelect.innerHTML='<option value="">-- Sélectionner --</option>';
                    data.forEach(a => arrondissementSelect.innerHTML += `<option value="${a.id}">${a.name}</option>`);
                } catch(e) { arrondissementSelect.innerHTML='<option>Erreur de chargement</option>'; }
            });

            arrondissementSelect.addEventListener('change', async () => {
                const id = arrondissementSelect.value;
                quartierSelect.innerHTML='<option>Chargement...</option>';
                if(!id) { quartierSelect.innerHTML='<option>-- Sélectionner un arrondissement --</option>'; return; }

                try {
                    const res = await fetch(`/api/quartiers/${id}`);
                    const data = await res.json();
                    quartierSelect.innerHTML='<option value="">-- Sélectionner --</option>';
                    data.forEach(q => quartierSelect.innerHTML += `<option value="${q.id}">${q.name}</option>`);
                } catch(e) { quartierSelect.innerHTML='<option>Erreur de chargement</option>'; }
            });
        });
    </script>
</body>
</html>
