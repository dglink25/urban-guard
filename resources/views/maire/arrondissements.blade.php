<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold text-green-700 mb-6">Mes Arrondissements</h1>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($arrondissements as $arrondissement)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition p-5">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $arrondissement->name }}</h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Chef : {{ $arrondissement->chef->name ?? 'Non défini' }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
