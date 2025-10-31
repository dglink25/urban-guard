<x-app-layout>
    <div class="p-6 max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-blue-700 mb-6">Demandes d’inscription en attente</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-3 text-left">N°</th>
                        <th class="p-3 text-left">Nom</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Rôle</th>
                        <th class="p-3 text-left">Commune</th>
                        <th class="p-3 text-left">Statut</th>
                        <th class="p-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">{{ $user->id }}</td>
                            <td class="p-3">{{ $user->name }}</td>
                            <td class="p-3">{{ $user->email }}</td>
                            <td class="p-3 capitalize">{{ $user->role }}</td>
                            <td class="p-3">{{ $user->commune->name ?? '-' }}</td>
                            <td class="p-3 text-yellow-600 font-semibold">En attente</td>
                            <td class="p-3 text-right space-x-2">
                                <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Valider</button>
                                </form>
                                <form action="{{ route('admin.users.reject', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Rejeter</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-6 text-gray-500">Aucune demande en attente</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
