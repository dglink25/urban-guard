<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nom -->
        <div>
            <x-input-label for="name" :value="__('Nom complet')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                          :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Adresse e-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                          :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Département et Commune -->
        <div class="grid md:grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block text-gray-700 mb-2">Département</label>
                <select id="departement-select" name="id_departement" required
                        class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="">-- Sélectionner --</option>
                    @foreach($departements as $departement)
                        <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Commune</label>
                <select id="commune-select" name="id_commune" required
                        class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="">-- Sélectionner un département --</option>
                </select>
            </div>
        </div>

        <!-- Arrondissement et Quartier -->
        <div class="grid md:grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block text-gray-700 mb-2">Arrondissement</label>
                <select id="arrondissement-select" name="id_arrondissement" required
                        class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="">-- Sélectionner une commune --</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Quartier</label>
                <select id="quartier-select" name="id_quartier" required
                        class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="">-- Sélectionner un arrondissement --</option>
                </select>
            </div>
        </div>

        <!-- Adresse -->
        <div class="grid md:grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block text-gray-700 mb-2">Rue</label>
                <input type="text" name="rue" value="{{ old('rue') }}" required
                       class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            <div>
                <label class="block text-gray-700 mb-2">Maison</label>
                <input type="text" name="maison" value="{{ old('maison') }}" required
                       class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
        </div>

        <!-- Rôle -->
        <div class="mt-4">
            <label class="block text-gray-700 mb-2">Rôle</label>
            <select name="role" required class="w-full border-gray-300 rounded-lg shadow-sm">
                <option value="">-- Sélectionner --</option>
                <option value="prefet">Préfet</option>
                <option value="maire">Maire</option>
                <option value="ca">Chef d’Arrondissement</option>
                <option value="cq">Chef de Quartier</option>
                <option value="conseiller">Conseiller</option>
            </select>
        </div>

        <!-- Mot de passe -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password"
                          name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmation -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                          name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900">Déjà inscrit ?</a>
            <x-primary-button class="ms-4">
                {{ __('S’inscrire') }}
            </x-primary-button>
        </div>
    </form>

    <!-- ===================== -->
    <!-- 🔧 SCRIPT DYNAMIQUE JS -->
    <!-- ===================== -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const departementSelect = document.getElementById('departement-select');
            const communeSelect = document.getElementById('commune-select');
            const arrondissementSelect = document.getElementById('arrondissement-select');
            const quartierSelect = document.getElementById('quartier-select');

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

                const response = await fetch(`/api/communes/${id}`);
                const data = await response.json();
                communeSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(c => {
                    communeSelect.innerHTML += `<option value="${c.id}">${c.name}</option>`;
                });
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

                const response = await fetch(`/api/arrondissements/${id}`);
                const data = await response.json();
                arrondissementSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(a => {
                    arrondissementSelect.innerHTML += `<option value="${a.id}">${a.name}</option>`;
                });
            });

            // Charger les quartiers selon l’arrondissement
            arrondissementSelect.addEventListener('change', async () => {
                const id = arrondissementSelect.value;
                quartierSelect.innerHTML = '<option value="">Chargement...</option>';

                if (!id) {
                    quartierSelect.innerHTML = '<option value="">-- Sélectionner un arrondissement --</option>';
                    return;
                }

                const response = await fetch(`/api/quartiers/${id}`);
                const data = await response.json();
                quartierSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(q => {
                    quartierSelect.innerHTML += `<option value="${q.id}">${q.name}</option>`;
                });
            });
        });
    </script>
</x-guest-layout>
