<x-app-layout>
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold text-blue-700 mb-4">Modifier le quartier</h1>

        <form method="POST" action="{{ route('quartiers.update', $quartier) }}" class="bg-white shadow-md rounded-lg p-6 space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-gray-700 mb-2">Nom du quartier</label>
                <input type="text" name="name" value="{{ old('name', $quartier->name) }}" required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Lien Google Maps</label>
                <input type="url" name="liens_google_maps"
                       value="{{ old('liens_google_maps', $quartier->liens_google_maps) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Département + Commune -->
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-2">Département</label>
                    <select id="departement-select" name="id_departement" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Sélectionner --</option>
                        @foreach($departements as $departement)
                            <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                        @endforeach
                    </select>
                    @error('id_departement') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 mb-2">Commune</label>
                    <select id="commune-select" name="id_commune" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Sélectionner un département d’abord --</option>
                    </select>
                    @error('id_commune') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Arrondissement -->
            <div>
                <label class="block text-gray-700 mb-2">Arrondissement</label>
                <select id="arrondissement-select" name="id_arrondissement" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Sélectionner une commune d’abord --</option>
                </select>
                @error('id_arrondissement') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>

    <!-- Script dynamique -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const departementSelect = document.getElementById('departement-select');
            const communeSelect = document.getElementById('commune-select');
            const arrondissementSelect = document.getElementById('arrondissement-select');

            // 🟦 Quand le département change
            departementSelect.addEventListener('change', function () {
                const departementId = this.value;
                communeSelect.innerHTML = '<option value="">Chargement...</option>';
                arrondissementSelect.innerHTML = '<option value="">-- Sélectionner une commune d’abord --</option>';

                if (!departementId) {
                    communeSelect.innerHTML = '<option value="">-- Sélectionner un département d’abord --</option>';
                    return;
                }

                fetch(`/communes/by-departement/${departementId}`)
                    .then(response => response.json())
                    .then(data => {
                        communeSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                        data.forEach(commune => {
                            const option = document.createElement('option');
                            option.value = commune.id;
                            option.textContent = commune.name;
                            communeSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        communeSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                        console.error('Erreur communes :', error);
                    });
            });

            // 🟧 Quand la commune change
            communeSelect.addEventListener('change', function () {
                const communeId = this.value;
                arrondissementSelect.innerHTML = '<option value="">Chargement...</option>';

                if (!communeId) {
                    arrondissementSelect.innerHTML = '<option value="">-- Sélectionner une commune d’abord --</option>';
                    return;
                }

                fetch(`/arrondissements/by-commune/${communeId}`)
                    .then(response => response.json())
                    .then(data => {
                        arrondissementSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                        data.forEach(arrondissement => {
                            const option = document.createElement('option');
                            option.value = arrondissement.id;
                            option.textContent = arrondissement.name;
                            arrondissementSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        arrondissementSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                        console.error('Erreur arrondissements :', error);
                    });
            });
        });
    </script>
</x-app-layout>
