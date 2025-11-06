<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-10 px-6">

    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-2xl p-8 border border-gray-100 animate-fadeIn">

        {{-- En-tête --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                Département de {{ $departement->name }}
            </h1>
            <p class="text-gray-500 text-sm mt-2">Détails complets du département</p>
        </div>

        {{-- Informations principales --}}
        <div class="grid md:grid-cols-3 gap-6 mb-10">
            <div class="bg-blue-50 p-4 rounded-xl text-center shadow-sm">
                <p class="text-sm text-gray-500">Préfet</p>
                <p class="text-lg font-semibold text-gray-800 mt-1">
                    {{ $departement->prefet->name ?? 'Non défini' }}
                </p>
            </div>

            <div class="bg-green-50 p-4 rounded-xl text-center shadow-sm">
                <p class="text-sm text-gray-500">Nombre de communes</p>
                <p class="text-lg font-semibold text-gray-800 mt-1">
                    {{ $nombreCommunes }}
                </p>
            </div>

            <div class="bg-indigo-50 p-4 rounded-xl text-center shadow-sm">
                <p class="text-sm text-gray-500">Email du préfet</p>
                <p class="text-lg font-semibold text-gray-800 mt-1">
                    {{ $departement->prefet->email ?? 'Non disponible' }}
                </p>
            </div>
        </div>

        {{-- Liste des communes --}}
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Liste des Communes</h2>

        @if($departement->communes->isEmpty())
            <p class="text-gray-500 italic">Aucune commune enregistrée dans ce département.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">#</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nom</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Maire</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($departement->communes as $index => $commune)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                    <a href="{{ route('communes.show', $commune->id) }}" class="text-blue-600 hover:underline">
                                        {{ $commune->name }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $commune->maire->name ?? 'Non défini' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Bouton retour --}}
        <div class="mt-10 text-center">
            <a href="{{ route('departements.index') }}"
                class="inline-block px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition shadow">
                ← Retour à la liste
            </a>
        </div>

    </div>
</div>

</x-app-layout>
