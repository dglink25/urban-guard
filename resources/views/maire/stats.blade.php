<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold text-green-700 mb-6">Statistiques de la Commune</h1>

        <div class="grid sm:grid-cols-2 gap-6">
            <div class="bg-green-50 rounded-xl p-6 shadow text-center">
                <p class="text-4xl font-bold text-green-700">{{ $arrondissementsCount }}</p>
                <p class="text-gray-600 mt-2">Arrondissements</p>
            </div>

            <div class="bg-emerald-50 rounded-xl p-6 shadow text-center">
                <p class="text-4xl font-bold text-emerald-700">{{ $citoyensCount }}</p>
                <p class="text-gray-600 mt-2">Citoyens</p>
            </div>
        </div>
    </div>
</x-app-layout>
