<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold text-indigo-700 mb-6">Mes Communes</h1>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($communes as $commune)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition p-5">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $commune->name }}</h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Maire : {{ $commune->maire->name ?? 'Non défini' }}
                    </p>
                    <p class="text-sm text-gray-400 mt-2">
                        Département #{{ $commune->id_departement }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
