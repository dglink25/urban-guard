<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold text-indigo-700 mb-4">
            Bienvenue dans votre département, {{ $user->name }}
        </h1>
        <p class="text-gray-600 mb-6">Voici vos communes et statistiques départementales.</p>

        <div class="grid sm:grid-cols-2 gap-6">
            <a href="{{ route('prefet.communes') }}" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-800">Mes Communes</h2>
                <p class="text-sm text-gray-500">Consulter la liste de vos communes.</p>
            </a>

            <a href="{{ route('prefet.stats') }}" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-800">Statistiques</h2>
                <p class="text-sm text-gray-500">Voir les indicateurs de votre département.</p>
            </a>
        </div>
    </div>
</x-app-layout>
