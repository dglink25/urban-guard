<nav x-data="{ open: false }" class="bg-white border-b border-indigo-100 shadow-xl/10">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Left: Logo/Brand (Optional - Assuming you'd add a logo here) -->
            <div class="flex-shrink-0 text-xl font-extrabold text-indigo-700 tracking-wider">
                ADMINISTRATION
            </div>

            <!-- Center: Navigation Links (Hidden on small screens) -->
            <div class="hidden sm:ml-6 sm:flex sm:space-x-4 lg:space-x-8">
                <!-- Les liens utilisent des classes optimisées pour un style plus "pro" -->
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="!px-3 !py-2 !text-sm !font-semibold transition duration-150 ease-in-out hover:text-indigo-800 hover:border-indigo-300 active:border-indigo-600">
                    {{ __('Dashboard') }}
                </x-nav-link>

                <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')" class="!px-3 !py-2 !text-sm !font-semibold transition duration-150 ease-in-out hover:text-indigo-800 hover:border-indigo-300 active:border-indigo-600">
                    {{ __('Demandes d\'inscription') }}
                </x-nav-link>

                <x-nav-link :href="route('departements.index')" :active="request()->routeIs('departements.index')" class="!px-3 !py-2 !text-sm !font-semibold transition duration-150 ease-in-out hover:text-indigo-800 hover:border-indigo-300 active:border-indigo-600">
                    {{ __('Départements') }}
                </x-nav-link>

                <x-nav-link :href="route('communes.index')" :active="request()->routeIs('communes.index')" class="!px-3 !py-2 !text-sm !font-semibold transition duration-150 ease-in-out hover:text-indigo-800 hover:border-indigo-300 active:border-indigo-600">
                    {{ __('Communes') }}
                </x-nav-link>

                <x-nav-link :href="route('arrondissements.index')" :active="request()->routeIs('arrondissements.index')" class="!px-3 !py-2 !text-sm !font-semibold transition duration-150 ease-in-out hover:text-indigo-800 hover:border-indigo-300 active:border-indigo-600">
                    {{ __('Arrondissements') }}
                </x-nav-link>

                <x-nav-link :href="route('quartiers.index')" :active="request()->routeIs('quartiers.index')" class="!px-3 !py-2 !text-sm !font-semibold transition duration-150 ease-in-out hover:text-indigo-800 hover:border-indigo-300 active:border-indigo-600">
                    {{ __('Quartiers') }}
                </x-nav-link>
            </div>

            <!-- Right: User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <!-- Bouton utilisateur plus stylisé et axé sur l'icône/l'avatar -->
                        <button class="flex items-center text-sm font-medium text-gray-600 hover:text-indigo-800 hover:border-gray-300 focus:outline-none focus:text-indigo-800 focus:border-indigo-300 transition duration-150 ease-in-out bg-gray-50 p-2 rounded-full border border-gray-200">
                            <!-- Placeholder pour un Avatar ou une Icône utilisateur -->
                            <svg class="h-6 w-6 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.511 0 4.905.748 6.914 2.015M12 12a4 4 0 100-8 4 4 0 000 8zm-2.484 6.848C7.575 16.5 5 13.79 5 10c0-4.418 3.582-8 8-8s8 3.582 8 8c0 3.79-2.575 6.5-4.516 8.848"></path></svg>
                            {{ Auth::user()->name }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-indigo-50 transition">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="hover:bg-red-50 text-red-600 hover:text-red-700 transition">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (mobile) -->
            <div class="sm:hidden -mr-2 flex items-center">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-indigo-700 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-gray-50 border-t border-indigo-100">
        <div class="pt-2 pb-3 space-y-1">
            <!-- J'ai ajouté des classes de style 'responsive' pour mieux refléter l'état actif/inactif en mobile -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">{{ __('Demandes d\'inscription') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('departements.index')" :active="request()->routeIs('departements.index')">{{ __('Départements') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('communes.index')" :active="request()->routeIs('communes.index')">{{ __('Communes') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('arrondissements.index')" :active="request()->routeIs('arrondissements.index')">{{ __('Arrondissements') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('quartiers.index')" :active="request()->routeIs('quartiers.index')">{{ __('Quartiers') }}</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-indigo-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
