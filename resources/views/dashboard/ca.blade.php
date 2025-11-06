<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold text-yellow-700 mb-4">
            Tableau de bord du Chef d’Arrondissement
        </h1>
        <p class="text-gray-600 mb-6">Bienvenue, {{ $user->name }}.</p>

        <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('ca.stats') }}" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-800">Statistiques Locales</h2>
                <p class="text-sm text-gray-500">Voir les citoyens et quartiers de votre zone.</p>
            </a>
        </div>
    </div>
</x-app-layout>
