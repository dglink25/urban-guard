<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">
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
