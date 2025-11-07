<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">

    <!-- MESSAGE DE SUCCÈS (Stylisé) -->

        {{-- Messages de succès --}}
        @if (session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700 border border-green-300">
                <strong>Succès :</strong> {{ session('success') }}
            </div>
        @endif

        {{-- Messages d'erreur généraux --}}
        @if (session('error'))
            <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700 border border-red-300">
                <strong>⚠ Erreur :</strong> {{ session('error') }}
            </div>
        @endif

        {{-- Erreurs de validation (Laravel) --}}
        @if ($errors->any())
            <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-300 text-red-700">
                <p class="font-semibold mb-2">Veuillez corriger les erreurs suivantes :</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <h1 class="text-2xl font-bold text-yellow-700 mb-6">Statistiques de l’Arrondissement</h1>

        <div class="grid sm:grid-cols-2 gap-6">
            <div class="bg-yellow-50 rounded-xl p-6 shadow text-center">
                <p class="text-4xl font-bold text-yellow-700">{{ $quartiersCount }}</p>
                <p class="text-gray-600 mt-2">Quartiers</p>
            </div>

            <div class="bg-orange-50 rounded-xl p-6 shadow text-center">
                <p class="text-4xl font-bold text-orange-700">{{ $citoyensCount }}</p>
                <p class="text-gray-600 mt-2">Citoyens</p>
            </div>
        </div>
    </div>
</x-app-layout>
