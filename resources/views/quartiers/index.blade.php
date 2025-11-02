<x-app-layout>
    <!-- Conteneur Alpine.js pour la gestion du modal de suppression -->
    <div x-data="{ showModal: false, deleteRoute: '' }" class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        
        <!-- EN-TÊTE : Titre et Bouton d'Action -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 p-4 bg-white rounded-xl shadow-lg border-l-4 border-indigo-500">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-2 sm:mb-0">
                Liste des Quartiers
            </h1>
            <a href="{{ route('quartiers.create') }}" class="w-full sm:w-auto bg-indigo-600 text-white font-semibold px-6 py-2.5 rounded-xl shadow-md hover:bg-indigo-700 transition duration-300 ease-in-out transform hover:scale-[1.02]">
                <i class="fas fa-plus mr-2"></i> + Ajouter un Quartier
            </a>
        </div>

        <!-- MESSAGE DE SUCCÈS (Stylisé) -->
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-lg mb-6 shadow-sm" role="alert">
                <p class="font-bold">Succès!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- CONTENEUR DU TABLEAU : Carte Élevée et Débordement Responsif -->
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden border border-gray-100">
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-xl">N°</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Département</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commune</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Arrondissement</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lien Maps</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Chef Quartier</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-xl">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($quartiers as $quartier)
                            <tr class="hover:bg-indigo-50 transition duration-150 ease-in-out odd:bg-white even:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $quartier->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">{{ $quartier->name }}</td>
                                <!-- J'ai réorganisé les colonnes pour mieux correspondre à l'ordre D-C-A (plus logique) -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $quartier->departement->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $quartier->commune->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $quartier->arrondissement->name ?? '-' }}</td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($quartier->liens_google_maps)
                                        <a href="{{ $quartier->liens_google_maps }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition duration-150 flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            <span>Voir</span>
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $quartier->cq->name ?? '-' }}</td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                    <!-- Bouton Modifier -->
                                    <a href="{{ route('quartiers.edit', $quartier) }}" class="text-indigo-600 hover:text-indigo-800 transition duration-150">
                                        Modifier
                                    </a>
                                    
                                    <!-- Bouton Supprimer (déclenche le modal) -->
                                    <button
                                        @click.prevent="showModal = true; deleteRoute = '{{ route('quartiers.destroy', $quartier) }}'"
                                        class="text-red-600 hover:text-red-800 transition duration-150"
                                        title="Supprimer ce quartier"
                                    >
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- PAGINATION -->
            <div class="p-4 bg-gray-50 border-t">
                {{ $quartiers->links() }}
            </div>
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
                
                <p class="text-gray-700 mb-6">Êtes-vous sûr de vouloir **supprimer définitivement** ce quartier ? Cette action est irréversible.</p>
                
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
