<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold text-indigo-700 mb-6">Statistiques du Département</h1>

        <div class="grid sm:grid-cols-2 gap-6">
            <div class="bg-indigo-50 rounded-xl p-6 shadow text-center">
                <p class="text-4xl font-bold text-indigo-700">{{ $communesCount }}</p>
                <p class="text-gray-600 mt-2">Communes</p>
            </div>

            <div class="bg-blue-50 rounded-xl p-6 shadow text-center">
                <p class="text-4xl font-bold text-blue-700">{{ $arrondissementsCount }}</p>
                <p class="text-gray-600 mt-2">Arrondissements</p>
            </div>
        </div>
    </div>
</x-app-layout>
