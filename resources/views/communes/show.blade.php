<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-10 px-6">

    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-2xl p-8 border border-gray-100 animate-fadeIn">

        {{-- Titre Commune --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                Commune de {{ $commune->name }}
            </h1>
            <p class="text-gray-500 text-sm mt-2">Détails complets de la commune</p>
        </div>

        {{-- Informations principales --}}
        <div class="grid md:grid-cols-3 gap-6 mb-10">
            <div class="bg-blue-50 p-4 rounded-xl text-center shadow-sm">
                <p class="text-sm text-gray-500">Maire</p>
                <p class="text-lg font-semibold text-gray-800 mt-1">
                    {{ $commune->maire->name ?? 'Non défini' }}
                </p>
            </div>

            <div class="bg-green-50 p-4 rounded-xl text-center shadow-sm">
                <p class="text-sm text-gray-500">Nombre d’arrondissements</p>
                <p class="text-lg font-semibold text-gray-800 mt-1">
                    {{ $nombreArrondissements }}
                </p>
            </div>

            <div class="bg-indigo-50 p-4 rounded-xl text-center shadow-sm">
                <p class="text-sm text-gray-500">Adresse e-mail du maire</p>
                <p class="text-lg font-semibold text-gray-800 mt-1">
                    {{ $commune->maire->email ?? 'Non disponible' }}
                </p>
            </div>
        </div>

        {{-- Liste des arrondissements --}}
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Liste des Arrondissements</h2>

        @if($commune->arrondissements->isEmpty())
            <p class="text-gray-500 italic">Aucun arrondissement enregistré pour cette commune.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">#</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nom</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Chef d’arrondissement</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($commune->arrondissements as $index => $arrondissement)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $arrondissement->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $arrondissement->ca->name ?? 'Non défini' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Bouton retour --}}
        <div class="mt-10 text-center">
            <a href="{{ route('communes.index') }}"
                class="inline-block px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition shadow">
                ← Retour à la liste
            </a>
        </div>

    </div>
</div>
</x-app-layout>
