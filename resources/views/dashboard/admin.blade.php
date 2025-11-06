<x-app-layout>
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        <div class="bg-white p-6 rounded-2xl shadow-xl border-l-4 border-indigo-500 mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">
                Tableau de bord administrateur
            </h1>
            <p class="text-lg text-gray-600">
                Bienvenue, <span class="font-bold text-indigo-600">{{ $user->name }}</span>.
            </p>
        </div>

        {{-- 🔢 Statistiques (tes cartes) --}}
        @include('partials.dashboard-stats-admin')
    </div>
</x-app-layout>
