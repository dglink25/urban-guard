<x-app-layout>
    <div class="p-4 sm:p-6 lg:p-8 max-w-2xl mx-auto">
        
        <!-- EN-TÊTE : Titre et Retour -->
        <div class="flex items-center space-x-4 mb-6">
            <a href="{{ route('quartiers.index') }}" class="text-gray-500 hover:text-indigo-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-3xl font-extrabold text-gray-800">
                Ajouter un Quartier
            </h1>
        </div>
        
        <!-- FORMULAIRE : Carte Élevée et Bordure Accent -->
        <form method="POST" action="{{ route('quartiers.store') }}" 
              class="bg-white shadow-2xl rounded-xl p-8 space-y-6 border-l-4 border-indigo-500 transition duration-300 hover:shadow-indigo-100/50">
            @csrf
            
            <!-- Champ Nom du quartier -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nom du Quartier <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 p-3"
                    placeholder="Ex: Fidjrossè Plage"
                >
                @error('name') 
                    <p class="text-red-600 text-sm mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $message }}
                    </p> 
                @enderror
            </div>

            <!-- Champ Lien Google Maps -->
            <div>
                <label for="liens_google_maps" class="block text-sm font-medium text-gray-700 mb-2">
                    Lien Google Maps (Optionnel)
                </label>
                <input 
                    type="url" 
                    id="liens_google_maps"
                    name="liens_google_maps" 
                    value="{{ old('liens_google_maps') }}"
                    placeholder="https://maps.google.com/..."
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 p-3"
                >
                @error('liens_google_maps') 
                    <p class="text-red-600 text-sm mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $message }}
                    </p> 
                @enderror
            </div>

            <!-- Départements et Communes -->
            <div class="grid sm:grid-cols-2 gap-6">
                <!-- Champ Département -->
                <div>
                    <label for="departement-select" class="block text-sm font-medium text-gray-700 mb-2">
                        Département <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="departement-select"
                        name="id_departement" 
                        required 
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 p-3"
                    >
                        <option value="">-- Sélectionner un Département --</option>
                        @foreach($departements as $departement)
                            <option value="{{ $departement->id }}" {{ old('id_departement') == $departement->id ? 'selected' : '' }}>
                                {{ $departement->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_departement') 
                        <p class="text-red-600 text-sm mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>
                
                <!-- Champ Commune (Dynamique) -->
                <div>
                    <label for="commune-select" class="block text-sm font-medium text-gray-700 mb-2">
                        Commune <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="commune-select"
                        name="id_commune" 
                        required 
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 p-3"
                    >
                        <option value="">
                            @if(old('id_commune'))
                                -- Rechargement des Communes --
                            @else
                                -- Sélectionner un Département d’abord --
                            @endif
                        </option>
                    </select>
                    @error('id_commune') 
                        <p class="text-red-600 text-sm mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>
            </div>

            <!-- Champ Arrondissement (Dynamique) -->
            <div>
                <label for="arrondissement-select" class="block text-sm font-medium text-gray-700 mb-2">
                    Arrondissement <span class="text-red-500">*</span>
                </label>
                <select 
                    id="arrondissement-select"
                    name="id_arrondissement" 
                    required 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 p-3"
                >
                    <option value="">
                        @if(old('id_arrondissement'))
                            -- Rechargement des Arrondissements --
                        @else
                            -- Sélectionner une Commune d’abord --
                        @endif
                    </option>
                </select>
                @error('id_arrondissement') 
                    <p class="text-red-600 text-sm mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $message }}
                    </p> 
                @enderror
            </div>


            <!-- Bouton d'action -->
            <div class="flex justify-end pt-4">
                <button 
                    type="submit" 
                    class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition duration-300 ease-in-out transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50"
                >
                    <i class="fas fa-save mr-2"></i> Enregistrer le Quartier
                </button>
            </div>
        </form>
    </div>

    <!-- Script AJAX pour le chargement dynamique des Communes et Arrondissements -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const departementSelect = document.getElementById('departement-select');
            const communeSelect = document.getElementById('commune-select');
            const arrondissementSelect = document.getElementById('arrondissement-select');

            // --- Fonctions de chargement ---
            
            // Charge les Arrondissements en fonction de la Commune
            function loadArrondissements(communeId, selectedArrondissementId = null) {
                arrondissementSelect.innerHTML = '<option value="">Chargement...</option>';

                if (!communeId) {
                    arrondissementSelect.innerHTML = '<option value="">-- Sélectionner une Commune d’abord --</option>';
                    return;
                }

                fetch(`/arrondissements/by-commune/${communeId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erreur réseau lors du chargement des arrondissements.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        arrondissementSelect.innerHTML = '<option value="">-- Sélectionner un Arrondissement --</option>';
                        data.forEach(arrondissement => {
                            const option = document.createElement('option');
                            option.value = arrondissement.id;
                            option.textContent = arrondissement.name;
                            if (selectedArrondissementId && arrondissement.id == selectedArrondissementId) {
                                option.selected = true;
                            }
                            arrondissementSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        arrondissementSelect.innerHTML = '<option value="">Erreur de chargement des arrondissements.</option>';
                        console.error('Erreur AJAX pour les arrondissements :', error);
                    });
            }

            // Charge les Communes en fonction du Département
            function loadCommunes(departementId, selectedCommuneId = null) {
                communeSelect.innerHTML = '<option value="">Chargement...</option>';
                // Réinitialise l'arrondissement lorsqu'on change de département
                arrondissementSelect.innerHTML = '<option value="">-- Sélectionner une Commune d’abord --</option>';


                if (!departementId) {
                    communeSelect.innerHTML = '<option value="">-- Sélectionner un Département d’abord --</option>';
                    return;
                }

                fetch(`/communes/by-departement/${departementId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erreur réseau lors du chargement des communes.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        communeSelect.innerHTML = '<option value="">-- Sélectionner une Commune --</option>';
                        data.forEach(commune => {
                            const option = document.createElement('option');
                            option.value = commune.id;
                            option.textContent = commune.name;
                            if (selectedCommuneId && commune.id == selectedCommuneId) {
                                option.selected = true;
                            }
                            communeSelect.appendChild(option);
                        });
                        
                        // Si une commune était sélectionnée (suite à une erreur de validation), charge ses arrondissements
                        if (selectedCommuneId) {
                          //  loadArrondissements(selectedCommuneId, '{{ old('id_arrondissement') }}');
                        }
                    })
                    .catch(error => {
                        communeSelect.innerHTML = '<option value="">Erreur de chargement des communes.</option>';
                        console.error('Erreur AJAX pour les communes :', error);
                    });
            }

            // --- Événements ---

            // 1. Événement sur changement de département
            departementSelect.addEventListener('change', function () {
                loadCommunes(this.value);
            });
            
            // 2. Événement sur changement de commune
            communeSelect.addEventListener('change', function () {
                loadArrondissements(this.value);
            });
            
            // --- Gestion du rechargement après erreur de validation (old values) ---
            
            const initialDepartementId = departementSelect.value;
           // const oldCommuneId = '{{ old('id_commune') }}';
           // const oldArrondissementId = '{{ old('id_arrondissement') }}';

            if (initialDepartementId) {
                 // Si le département est déjà sélectionné (normal ou après validation), charge les communes.
                 loadCommunes(initialDepartementId, oldCommuneId);
                 // La fonction loadCommunes va elle-même appeler loadArrondissements si oldCommuneId est présent.
            }
        });
    </script>
</x-app-layout>
