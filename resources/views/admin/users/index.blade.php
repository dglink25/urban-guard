<x-app-layout>
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        
        <!-- EN-TÊTE : Titre -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 p-4 bg-white rounded-xl shadow-lg border-l-4 border-indigo-500">
            <h1 class="text-3xl font-extrabold text-gray-800">
                Demandes d’inscription en attente
            </h1>
        </div>

        <!-- MESSAGES FLASH (Succès et Erreur) -->
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-lg mb-6 shadow-sm" role="alert">
                <p class="font-bold">Succès!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 rounded-lg mb-6 shadow-sm" role="alert">
                <p class="font-bold">Erreur!</p>
                <p>{{ session('error') }}</p>
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commune</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-xl">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr class="hover:bg-indigo-50 transition duration-150 ease-in-out odd:bg-white even:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 capitalize font-medium">{{ $user->role }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->commune->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        En attente
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <!-- Bouton Valider (Approuver) -->
                                    <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="inline">
                                        @csrf
                                        <button class="bg-green-600 text-white px-4 py-2 text-sm rounded-lg hover:bg-green-700 transition duration-150 shadow-md">
                                            Valider
                                        </button>
                                    </form>
                                    
                                    <!-- Bouton Rejeter -->
                                    <form action="{{ route('admin.users.reject', $user) }}" method="POST" class="inline">
                                        @csrf
                                        <button class="bg-red-600 text-white px-4 py-2 text-sm rounded-lg hover:bg-red-700 transition duration-150 shadow-md">
                                            Rejeter
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center p-12 text-gray-500 text-lg bg-white">
                                    <i class="far fa-check-circle mr-2"></i> Aucune demande d'inscription en attente.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- PAGINATION (si vous ajoutez la pagination ultérieurement, décommenter cette section) -->
            {{-- <div class="p-4 bg-gray-50 border-t">
                {{ $users->links() }}
            </div> --}}
        </div>
    </div>
</x-app-layout>
