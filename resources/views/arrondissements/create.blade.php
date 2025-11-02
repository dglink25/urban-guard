<x-app-layout>
    <div class="p-4 sm:p-6 lg:p-8 max-w-2xl mx-auto">
        
        <!-- EN-TÊTE : Titre et Retour -->
        <div class="flex items-center space-x-4 mb-6">
            <a href="{{ route('arrondissements.index') }}" class="text-gray-500 hover:text-indigo-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-3xl font-extrabold text-gray-800">
                Ajouter un Arrondissement
            </h1>
        </div>
        
        <!-- FORMULAIRE : Carte Élevée et Bordure Accent -->
        <form method="POST" action="{{ route('arrondissements.store') }}" 
              class="bg-white shadow-2xl rounded-xl p-8 space-y-6 border-l-4 border-indigo-500 transition duration-300 hover:shadow-indigo-100/50">
            @csrf
            
            <!-- Champ Nom de l’arrondissement -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nom de l’Arrondissement <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 p-3"
                    placeholder="Ex: Cotonou 1er"
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
                    <!-- Le JavaScript gère la mise à jour des options, mais nous conservons l'ancienne sélection en cas d'erreur de validation -->
                    <option value="">
                        @if(old('id_commune'))
                            -- Rechargement des Communes --
                        @else
                            -- Sélectionner un Département d’abord --
                        @endif
                    </option>
                    {{-- Si old('id_commune') est présent, vous pouvez ajouter une option temporaire ici, mais le JS le chargera dynamiquement. --}}
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
                    <i class="fas fa-save mr-2"></i> Enregistrer l’Arrondissement
                </button>
            </div>
        </form>
    </div>

    <!-- Script AJAX pour le chargement dynamique des communes -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const departementSelect = document.getElementById('departement-select');
            const communeSelect = document.getElementById('commune-select');

            // Fonction pour charger les communes
            function loadCommunes(departementId, selectedCommuneId = null) {
                communeSelect.innerHTML = '<option value="">Chargement...</option>';

                if (!departementId) {
                    communeSelect.innerHTML = '<option value="">-- Sélectionner un Département d’abord --</option>';
                    return;
                }

                // NOTE: Assurez-vous que cette route existe dans votre backend Laravel.
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
                    })
                    .catch(error => {
                        communeSelect.innerHTML = '<option value="">Erreur de chargement des communes.</option>';
                        console.error('Erreur AJAX pour les communes :', error);
                    });
            }

            // Événement sur changement de département
            departementSelect.addEventListener('change', function () {
                loadCommunes(this.value);
            });
            
            // Gestion du rechargement après une erreur de validation (old('id_departement'))
            const initialDepartementId = departementSelect.value;
           // const oldCommuneId = '{{ old('id_commune') }}'; // Récupère l'ancienne valeur
            
            if (initialDepartementId && oldCommuneId) {
                 // Charge les communes correspondant au département sélectionné et sélectionne l'ancienne commune
                loadCommunes(initialDepartementId, oldCommuneId);
            } else if (initialDepartementId) {
                // Charge les communes sans sélection particulière si le département est déjà choisi (ex: en mode édition)
                 loadCommunes(initialDepartementId);
            }
        });
    </script>
</x-app-layout>
