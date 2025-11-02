<x-app-layout>
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        
        <!-- EN-TÊTE : Titre du Profil -->
        <header class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800">
                Paramètres du Profil
            </h1>
            <p class="mt-1 text-base text-gray-600">
                Gérez les informations de votre compte et vos préférences de sécurité.
            </p>
        </header>

        <!-- Conteneur principal (avec espacement vertical plus large) -->
        <div class="space-y-8">
            
            <!-- Bloc 1: Mise à jour des informations de profil -->
            <div class="p-6 sm:p-8 bg-white shadow-2xl rounded-xl border-l-4 border-indigo-500 transition duration-300 hover:shadow-indigo-100/50">
                <div class="max-w-xl">
                    {{-- Le contenu de la mise à jour du profil (nom, email) est inclus ici --}}
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Bloc 2: Mise à jour du mot de passe -->
            <div class="p-6 sm:p-8 bg-white shadow-2xl rounded-xl border-l-4 border-indigo-500 transition duration-300 hover:shadow-indigo-100/50">
                <div class="max-w-xl">
                    {{-- Le contenu de la mise à jour du mot de passe est inclus ici --}}
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Bloc 3: Suppression du compte -->
            <div class="p-6 sm:p-8 bg-white shadow-2xl rounded-xl border-l-4 border-red-500 transition duration-300 hover:shadow-red-100/50">
                <div class="max-w-xl">
                    {{-- Le contenu de la suppression du compte est inclus ici --}}
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
