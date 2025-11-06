<x-app-layout>
    <!--
        Ajout du contexte Alpine.js pour la gestion du modal de suppression.
        Alpine.js est supposé être chargé via votre layout (x-app-layout).
    -->
    <div x-data="{ showModal: false, deleteRoute: '' }" class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        
        <!-- EN-TÊTE : Titre et Bouton d'Action -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 p-4 bg-white rounded-xl shadow-lg border-l-4 border-blue-500">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-2 sm:mb-0">
                Administration des Communes
            </h1>
            <a href="{{ route('communes.create') }}" class="w-full sm:w-auto bg-indigo-600 text-white font-semibold px-6 py-2.5 rounded-xl shadow-md hover:bg-indigo-700 transition duration-300 ease-in-out transform hover:scale-[1.02]">
                <i class="fas fa-plus mr-2"></i> + Ajouter une Commune
            </a>
        </div>

        <!-- MESSAGE DE SUCCÈS (Stylisé) -->
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-lg mb-6 shadow-sm" role="alert">
                <p class="font-bold">Succès!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- 📘 LISTE DES COMMUNES -->
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100">

            <!-- TITRE ET BARRE D’ACTIONS -->
            <div class="flex flex-col sm:flex-row justify-between items-center p-6 border-b bg-gradient-to-r from-blue-50 to-indigo-50">
                <h2 class="text-lg font-semibold text-gray-800">Liste des Communes</h2>
                <a href="{{ route('communes.create') }}"
                class="mt-3 sm:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition duration-150">
                + Ajouter une Commune
                </a>
            </div>

            <!-- TABLEAU RESPONSIVE -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">N°</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Département</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Maire</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($communes as $index => $commune)
                            <tr class="hover:bg-blue-50 transition duration-150 ease-in-out odd:bg-white even:bg-gray-50">
                                <!-- Numéro -->
                                <td class="px-6 py-4 text-sm text-gray-800 font-semibold">
                                    {{ $loop->iteration + ($communes->currentPage() - 1) * $communes->perPage() }}
                                </td>
                                <!-- Nom -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">
                                    <a href="{{ route('communes.show', $commune->id) }}">
                                        {{ $commune->name }}
                                    </a>
                                </td>
                                <!-- Département -->
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $commune->departement->name ?? '-' }}
                                </td>
                                <!-- Maire -->
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $commune->maire->name ?? 'Non défini' }}
                                </td>
                                <!-- Actions -->
                                <td class="px-6 py-4 text-right text-sm font-medium space-x-3">
                                    <a href="{{ route('communes.edit', $commune) }}"
                                    class="inline-block text-blue-600 hover:text-blue-800 font-semibold transition duration-150">
                                        Modifier
                                    </a>
                                    <button
                                        @click.prevent="showModal = true; deleteRoute = '{{ route('communes.destroy', $commune) }}'"
                                        class="inline-block text-red-600 hover:text-red-800 font-semibold transition duration-150"
                                        title="Supprimer la commune">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-6 text-center text-gray-500 text-sm">
                                    Aucune commune enregistrée pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            @if ($communes->hasPages())
                <div class="p-4 bg-gray-50 border-t flex justify-center">
                    {{ $communes->links('pagination::tailwind') }}
                </div>
            @endif
        </div>

        
        <!-- MODAL DE CONFIRMATION DE SUPPRESSION (Alpine.js) -->
        <div x-show="showModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50 p-4"
             style="display: none;"
        >
            <div @click.away="showModal = false"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="bg-white rounded-lg overflow-hidden shadow-xl max-w-lg w-full transform transition-all p-6"
            >
                <h3 class="text-xl font-bold text-red-600 border-b pb-3 mb-4">Confirmer la Suppression</h3>
                
                <p class="text-gray-700 mb-6">Êtes-vous sûr de vouloir **supprimer définitivement** cette commune ? Cette action est irréversible.</p>
                
                <div class="flex justify-end space-x-4">
                    <!-- Bouton Annuler -->
                    <button @click="showModal = false" type="button" class="px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition duration-150">
                        Annuler
                    </button>
                    
                    <!-- Bouton Confirmer la Suppression -->
                    <form x-bind:action="deleteRoute" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition duration-150">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
