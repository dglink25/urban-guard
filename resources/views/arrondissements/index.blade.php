<x-app-layout>
    <div class="p-6 max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-blue-700">Liste des arrondissements</h1>
            <a href="{{ route('arrondissements.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">+ Ajouter</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-3">#</th>
                        <th class="p-3">Nom</th>
                        <th class="p-3">Département</th>
                        <th class="p-3">Commune</th>
                        <th class="p-3">Chef d’arrondissement</th>
                        <th class="p-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($arrondissements as $arrondissement)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-3">{{ $arrondissement->id }}</td>
                            <td class="p-3">{{ $arrondissement->name }}</td>
                            <td class="p-3">{{ $arrondissement->departement->name ?? '-' }}</td>
                            <td class="p-3">{{ $arrondissement->commune->name ?? '-' }}</td>
                            <td class="p-3">{{ $arrondissement->ca->name ?? '-' }}</td>
                            <td class="p-3 text-right space-x-2">
                                <a href="{{ route('arrondissements.edit', $arrondissement) }}" class="text-blue-600 hover:underline">Modifier</a>
                                <form action="{{ route('arrondissements.destroy', $arrondissement) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Supprimer cet arrondissement ?')" class="text-red-600 hover:underline">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $arrondissements->links() }}</div>
    </div>
</x-app-layout>
