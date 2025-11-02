<x-app-layout>
    <div class="p-4 sm:p-6 lg:p-8 max-w-2xl mx-auto">
        
        <!-- EN-TÊTE : Titre et Retour -->
        <div class="flex items-center space-x-4 mb-6">
            <a href="{{ route('arrondissements.index') }}" class="text-gray-500 hover:text-indigo-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-3xl font-extrabold text-gray-800">
                Modifier l’Arrondissement
            </h1>
        </div>
        
        <!-- FORMULAIRE : Carte Élevée et Bordure Accent -->
        <form method="POST" action="{{ route('arrondissements.update', $arrondissement) }}" 
              class="bg-white shadow-2xl rounded-xl p-8 space-y-6 border-l-4 border-indigo-500 transition duration-300 hover:shadow-indigo-100/50">
            @csrf 
            @method('PUT')
            
            <!-- Champ Nom de l’arrondissement -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nom de l’Arrondissement <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $arrondissement->name) }}" 
                    required 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 p-3"
                    placeholder="Ex: Centre"
                >
                @error('name') 
                    <p class="text-red-600 text-sm mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $message }}
                    </p> 
                @enderror
            </div>
            
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
                        {{-- On utilise le département de la commune actuelle pour la présélection --}}
                        @php
                            $selectedDepartementId = old('id_departement', $arrondissement->commune->id_departement ?? null);
                        @endphp
                        <option 
                            value="{{ $departement->id }}" 
                            @selected($departement->id == $selectedDepartementId)
                        >
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
                    {{-- Le contenu sera chargé par JS --}}
                    <option value="{{ old('id_commune', $arrondissement->id_commune) }}">
                        @if(old('id_commune', $arrondissement->id_commune))
                            -- Chargement des communes --
                        @else
                            -- Sélectionner un département d’abord --
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

            <!-- Bouton d'action -->
            <div class="flex justify-end pt-4">
                <button 
                    type="submit" 
                    class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition duration-300 ease-in-out transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50"
                >
                    <i class="fas fa-edit mr-2"></i> Mettre à jour l’Arrondissement
                </button>
            </div>
        </form>
    </div>

    <!-- Script AJAX pour le chargement dynamique des Communes -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const departementSelect = document.getElementById('departement-select');
            const communeSelect = document.getElementById('commune-select');
            
            // Récupère l'ID de la commune actuellement modifiée (pour la présélection)
          //  const oldCommuneId = '{{ old('id_commune', $arrondissement->id_commune) }}';

            // Fonction pour charger et remplir la liste des communes
            function loadCommunes(departementId, selectedCommuneId = null) {
                communeSelect.innerHTML = '<option value="">Chargement...</option>';

                if (!departementId) {
                    communeSelect.innerHTML = '<option value="">-- Sélectionner un département d’abord --</option>';
                    return;
                }
                
                // Utilisation de fetch avec gestion d'erreur
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
                            
                            // Sélectionne la commune si elle correspond à l'ancienne valeur
                            if (selectedCommuneId && commune.id == selectedCommuneId) {
                                option.selected = true;
                            }
                            communeSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        communeSelect.innerHTML = '<option value="">Erreur de chargement des communes.</option>';
                        console.error('Erreur AJAX pour les communes :', error);
                    });
            }

            // Événement sur changement de département
            departementSelect.addEventListener('change', function () {
                // Si le département change, on ne présélectionne rien
                loadCommunes(this.value);
            });
            
            // Chargement initial au DOMContentLoaded pour l'édition
            // Si un département est déjà sélectionné (ce qui devrait toujours être le cas en mode édition)
            const initialDepartementId = departementSelect.value; 
            if (initialDepartementId) {
                 // Charge les communes en présélectionnant l'ancienne valeur
                 loadCommunes(initialDepartementId, oldCommuneId);
            }
        });
    </script>
</x-app-layout>
