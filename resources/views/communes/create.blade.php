<x-app-layout>
    <div class="max-w-xl mx-auto p-6">
        <h1 class="text-2xl font-bold text-blue-700 mb-4">Ajouter une commune</h1>

        <form method="POST" action="{{ route('communes.store') }}" class="bg-white shadow-md rounded-lg p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 mb-2">Nom de la commune</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Département</label>
                <select name="id_departement" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Sélectionner --</option>
                    @foreach($departements as $departement)
                        <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                    @endforeach
                </select>
                @error('id_departement') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Enregistrer</button>
            </div>
        </form>
    </div>
</x-app-layout>
