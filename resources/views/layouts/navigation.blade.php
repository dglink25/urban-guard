<nav x-data="{ open: false }" class="bg-white border-b border-indigo-100 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- 🏛️ Logo / Titre -->
            <div class="flex-shrink-0 text-xl font-extrabold text-indigo-700 tracking-wide">
                ADMINISTRATION
            </div>

            <x-nav-link :href="route('dashboard.declarations')" :active="request()->routeIs('dashboard.*')">
                {{ __('Tableau de Bord') }}
            </x-nav-link>

            <!-- 🧭 Liens principaux -->
            <div class="hidden sm:flex space-x-6 items-center">
                @switch(Auth::user()->role)
                    @case('admin')
                        <x-nav-link :href="route('departements.index')" :active="request()->routeIs('departements.*')">
                            {{ __('Départements') }}
                        </x-nav-link>

                        <x-nav-link :href="route('communes.index')" :active="request()->routeIs('communes.*')">
                            {{ __('Communes') }}
                        </x-nav-link>

                        <x-nav-link :href="route('arrondissements.index')" :active="request()->routeIs('arrondissements.*')">
                            {{ __('Arrondissements') }}
                        </x-nav-link>
                        @break

                    @case('prefet')

                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard.*')">
                            {{ __('Mon département') }}
                        </x-nav-link>
                        <x-nav-link :href="route('prefet.communes')" :active="request()->routeIs('prefet.communes')">
                            {{ __('Mes communes') }}
                        </x-nav-link>

                        <x-nav-link :href="route('prefet.stats')" :active="request()->routeIs('prefet.stats')">
                            {{ __('Statistiques du département') }}
                        </x-nav-link>
                        @break

                    @case('maire')

                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard.*')">
                            {{ __('Ma Commune') }}
                        </x-nav-link>

                        <x-nav-link :href="route('maire.arrondissements')" :active="request()->routeIs('maire.arrondissements')">
                            {{ __('Mes arrondissements') }}
                        </x-nav-link>

                        <x-nav-link :href="route('maire.stats')" :active="request()->routeIs('maire.stats')">
                            {{ __('Statistiques de la commune') }}
                        </x-nav-link>
                        @break

                    @case('chef_arrondissement')

                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard.*')">
                            {{ __('Mon Arrondissement') }}
                        </x-nav-link>

                        <x-nav-link :href="route('ca.stats')" :active="request()->routeIs('ca.stats')">
                            {{ __('Statistiques de l\'arrondissement') }}
                        </x-nav-link>
                        @break
                @endswitch
            </div>

            <!-- 👤 Menu utilisateur -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-700 hover:text-indigo-800 bg-gray-50 p-2 rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                            <svg class="h-6 w-6 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.511 0 4.905.748 6.914 2.015M12 12a4 4 0 100-8 4 4 0 000 8z"/>
                            </svg>
                            {{ Auth::user()->name }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profil') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-red-600 hover:bg-red-50 hover:text-red-700">
                                {{ __('Déconnexion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- 🍔 Bouton mobile -->
            <div class="sm:hidden -mr-2 flex items-center">
                <button @click="open = !open" class="p-2 rounded-md text-gray-600 hover:text-indigo-700 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- 📱 Menu mobile -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-gray-50 border-t border-indigo-100">
        <div class="pt-2 pb-3 space-y-1">
            @switch(Auth::user()->role)
                @case('admin')
                    <x-responsive-nav-link :href="route('departements.index')" :active="request()->routeIs('departements.*')">{{ __('Départements') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('communes.index')" :active="request()->routeIs('communes.*')">{{ __('Communes') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('arrondissements.index')" :active="request()->routeIs('arrondissements.*')">{{ __('Arrondissements') }}</x-responsive-nav-link>
                    @break

                @case('prefet')
                    <x-responsive-nav-link :href="route('prefet.communes')" :active="request()->routeIs('prefet.communes')">{{ __('Mes communes') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('prefet.stats')" :active="request()->routeIs('prefet.stats')">{{ __('Statistiques du département') }}</x-responsive-nav-link>
                    @break

                @case('maire')
                    <x-responsive-nav-link :href="route('maire.arrondissements')" :active="request()->routeIs('maire.arrondissements')">{{ __('Mes arrondissements') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('maire.stats')" :active="request()->routeIs('maire.stats')">{{ __('Statistiques de la commune') }}</x-responsive-nav-link>
                    @break

                @case('chef_arrondissement')
                    <x-responsive-nav-link :href="route('ca.stats')" :active="request()->routeIs('ca.stats')">{{ __('Statistiques de l\'arrondissement') }}</x-responsive-nav-link>
                    @break
            @endswitch
        </div>

        <!-- Utilisateur (mobile) -->
        <div class="pt-4 pb-3 border-t border-indigo-100">
            <div class="px-4">
                <div class="font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profil') }}</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Déconnexion') }}</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
