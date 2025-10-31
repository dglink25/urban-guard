<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold text-blue-700 mb-4">Tableau de bord administrateur</h1>
        <p class="text-gray-600">Bienvenue {{ Auth::user()->name }}</p>

        <div class="mt-6 animate__animated animate__fadeInUp">
            <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100">
                <h2 class="text-lg font-semibold mb-2">Gestion du site</h2>
                <ul class="list-disc ml-6 text-gray-700">
                    <li>Gérer les utilisateurs</li>
                    <li>Gérer le contenu du site</li>
                    <li>Paramètres système</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>















Maintenant je veux créer migrations departements : id, name, id_prefect (clé étrangère de la table users); communes : id, name, id_departement (clé étrangère de la table departements), id_maire (clé étrangère de la table users); arrondissements : id, name, id_departement (clé étrangère table departements), id_ca (clé étrangère table users), id_commune (clé étrangère de la table communes) et quatiers : id, name, liens_google_maps, id_departement (clé étrangère table departements), id_cq (clé étrangère table users), id_commune (clé étrangère de la table communes), id_arrondissement (clé étrangère de la table arrondissements). Je veux migrations et models avec les relations complets 