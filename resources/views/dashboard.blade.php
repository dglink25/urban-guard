<x-app-layout>
    <!-- Conteneur principal centré et responsive -->
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        
        <!-- EN-TÊTE DE BIENVENUE -->
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl border-l-4 border-indigo-500 mb-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-2">
                Tableau de bord administrateur
            </h1>
            <!-- Le composant 'Auth::user()->name' est conservé -->
            <p class="text-lg text-gray-600">Bienvenue , <span class="font-bold text-indigo-600">{{ Auth::user()->name }}</span>. Voici un aperçu rapide des activités.</p>
        </div>

        <!-- SECTION DES STATISTIQUES (KPIs) -->
        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Statistiques Clés</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            
            <!-- Carte 1: Communes (Données maquettes) -->
            <div class="bg-white p-6 rounded-xl shadow-lg transition duration-300 hover:shadow-2xl hover:ring-2 hover:ring-blue-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-2m-9 0H7m3 0V3m-4 8h8m-8 4h8m-8 4h8"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Communes</p>
                        <p class="text-3xl font-bold text-gray-900">120</p>
                    </div>
                </div>
            </div>

            <!-- Carte 2: Départements (Données maquettes) -->
            <div class="bg-white p-6 rounded-xl shadow-lg transition duration-300 hover:shadow-2xl hover:ring-2 hover:ring-green-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Départements</p>
                        <p class="text-3xl font-bold text-gray-900">12</p>
                    </div>
                </div>
            </div>
            
            <!-- Carte 3: Demandes en Attente (Données maquettes) -->
            <div class="bg-white p-6 rounded-xl shadow-lg transition duration-300 hover:shadow-2xl hover:ring-2 hover:ring-yellow-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Demandes en Attente</p>
                        <p class="text-3xl font-bold text-gray-900 text-yellow-600">5</p>
                    </div>
                </div>
            </div>

            <!-- Carte 4: Utilisateurs Enregistrés (Données maquettes) -->
            <div class="bg-white p-6 rounded-xl shadow-lg transition duration-300 hover:shadow-2xl hover:ring-2 hover:ring-indigo-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292m0 5.292a4 4 0 00-4 4v1H20v-1a4 4 0 00-4-4m-8-2h8"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Utilisateurs Enregistrés</p>
                        <p class="text-3xl font-bold text-gray-900">45</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION GESTION DU SITE (Transformée en Cartes d'Action) -->
        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Outils d'Administration</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Carte 1: Gérer les utilisateurs -->
            <!-- J'ai simulé une route, si elle est définie, utilisez-la. Sinon, utilisez '#'. -->
            <a href="{{ route('admin.users.index') ?? '#' }}" class="block bg-white p-6 rounded-xl shadow-xl border border-gray-100 hover:shadow-2xl hover:ring-2 hover:ring-indigo-500 transition duration-300 group">
                <div class="flex items-start">
                    <div class="p-3 rounded-lg bg-indigo-500 text-white group-hover:bg-indigo-600 transition">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20h2m-2 0h-2m2-12a5 5 0 100 10-5 5 0 000-10zM5.356 18.143A3 3 0 005 20h2v-2z"></path></svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-indigo-600">Gérer les utilisateurs</h3>
                        <p class="text-sm text-gray-500">Approuver les inscriptions et gérer les rôles.</p>
                    </div>
                </div>
            </a>
            
            <!-- Carte 2: Gérer le contenu du site -->
            <a href="#" class="block bg-white p-6 rounded-xl shadow-xl border border-gray-100 hover:shadow-2xl hover:ring-2 hover:ring-green-500 transition duration-300 group">
                <div class="flex items-start">
                    <div class="p-3 rounded-lg bg-green-500 text-white group-hover:bg-green-600 transition">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-green-600">Gérer les données géographiques</h3>
                        <p class="text-sm text-gray-500">Départements, communes, arrondissements et quartiers.</p>
                    </div>
                </div>
            </a>

            <!-- Carte 3: Paramètres système -->
            <a href="#" class="block bg-white p-6 rounded-xl shadow-xl border border-gray-100 hover:shadow-2xl hover:ring-2 hover:ring-yellow-500 transition duration-300 group">
                <div class="flex items-start">
                    <div class="p-3 rounded-lg bg-yellow-500 text-white group-hover:bg-yellow-600 transition">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37h.003z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-yellow-600">Paramètres Système</h3>
                        <p class="text-sm text-gray-500">Configurer les options globales et les notifications.</p>
                    </div>
                </div>
            </a>

        </div>
    </div>
</x-app-layout>
