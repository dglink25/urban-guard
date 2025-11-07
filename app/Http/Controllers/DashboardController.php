<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Declaration;
use App\Models\Departement;
use App\Models\Commune;
use App\Models\Arrondissement;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller{
    public function index(){
        $user = Auth::user();

        // 👇 On charge la vue correspondant au rôle
        switch ($user->role) {
            case 'admin':
                return view('dashboard.admin', compact('user'));

            case 'prefet':
                return view('dashboard.prefet', compact('user'));

            case 'maire':
                return view('dashboard.maire', compact('user'));

            case 'chef_arrondissement':
                return view('dashboard.ca', compact('user'));

            default:
                return view('dashboard.default', compact('user'));
        }
    }

    /**
     * Affiche le tableau de bord des déclarations selon le rôle
     */
    public function defaut(Request $request){
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login');
            }

            // Récupérer les déclarations selon le rôle
            $declarations = $this->getDeclarationsByRole($user);
            
            // Déclarations suivies par l'utilisateur
            $followedDeclarations = $this->getFollowedDeclarations($user);
            
            // Préparer les données pour la carte
            $declarationsMap = $declarations->map(function ($declaration) use ($user) {
                return [
                    'id' => $declaration->id,
                    'latitude' => $declaration->latitude,
                    'longitude' => $declaration->longitude,
                    'description' => $declaration->description,
                    'urgence' => $declaration->urgence,
                    'statut' => $declaration->statut,
                    'infrastructure_type' => $declaration->infrastructure_type,
                    'created_at' => $declaration->created_at->format('d/m/Y H:i'),
                    'user_name' => $declaration->user->name ?? 'Anonyme',
                    'commune' => $declaration->commune->name ?? null,
                    'departement' => $declaration->departement->name ?? null,
                    'type' => 'general',
                    'has_images' => $declaration->media()->where('type', 'image')->exists(),
                    'has_videos' => $declaration->media()->where('type', 'video')->exists(),
                ];
            });

            // Données pour les limites de la carte (Bénin)
            $beninBounds = [
                'north' => 12.5,
                'south' => 6.0,
                'east' => 3.9,
                'west' => 0.8,
                'center' => [9.5, 2.25]
            ];

            return view('dashboard.declarations', compact(
                'declarations', 
                'followedDeclarations',
                'declarationsMap',
                'beninBounds'
            ));

        } 
        catch (\Exception $e) {
            Log::error('Erreur dashboard déclarations: ' . $e->getMessage());
            return back()->with('error', 'Erreur lors du chargement des déclarations.'. $e->getMessage());
        }
    }

    /**
     * Récupère les déclarations selon le rôle de l'utilisateur
     */
    private function getDeclarationsByRole($user){
        $query = Declaration::with(['user', 'departement', 'commune', 'arrondissement', 'media'])
            ->where('statut', '==', 'en attente');

        switch ($user->role) {
            case 'prefet':
                // Récupérer le département de l'utilisateur
                if ($user->departement_id) {
                    $query->where('id_departement', $user->id_departement);
                } else {
                    // Fallback: utiliser la géolocalisation pour déterminer le département
                    $userDepartement = $this->getUserDepartementFromLocation($user);
                    if ($userDepartement) {
                        $query->where('departement_id', $userDepartement->id);
                    }
                }
                break;

            case 'maire':
                // Récupérer la commune de l'utilisateur
                if ($user->commune_id) {
                    $query->where('id_commune', $user->id_commune);
                } else {
                    // Fallback: utiliser la géolocalisation
                    $userCommune = $this->getUserCommuneFromLocation($user);
                    if ($userCommune) {
                        $query->where('commune_id', $userCommune->id);
                    }
                }
                break;

            case 'chef_arrondissement':
                // Récupérer l'arrondissement de l'utilisateur
                if ($user->arrondissement_id) {
                    $query->where('id_arrondissement', $user->id_arrondissement);
                } else {
                    // Fallback: utiliser la géolocalisation
                    $userArrondissement = $this->getUserArrondissementFromLocation($user);
                    if ($userArrondissement) {
                        $query->where('arrondissement_id', $userArrondissement->id);
                    }
                }
                break;

            default:
                // Pour les citoyens, afficher les déclarations proches
                $userLocation = $this->getUserLocation($user);
                if ($userLocation) {
                    $query->whereRaw("
                        (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * 
                        cos(radians(longitude) - radians(?)) + sin(radians(?)) * 
                        sin(radians(latitude)))) < 50
                    ", [$userLocation['lat'], $userLocation['lng'], $userLocation['lat']]);
                }
                break;
        }

        return $query->latest()->get();
    }

    /**
     * Récupère les déclarations suivies par l'utilisateur
     */
    private function getFollowedDeclarations($user){
        return Declaration::whereHas('followers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['user', 'departement', 'commune', 'media'])
        ->latest()
        ->get();
    }

    /**
     * Filtre les déclarations via API
     */
    public function filterDeclarations(Request $request)
    {
        try {
            $user = Auth::user();
            $filter = $request->get('filter', 'all');
            $urgence = $request->get('urgence', false);

            $query = Declaration::with(['user', 'departement', 'commune', 'media']);

            // Appliquer le filtre selon le rôle
            $query = $this->applyRoleFilter($query, $user);

            // Appliquer les filtres supplémentaires
            switch ($filter) {
                case 'followed':
                    $query->whereHas('followers', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                    });
                    break;
                case 'urgence':
                    $query->where('urgence', true);
                    break;
            }

            if ($urgence) {
                $query->where('urgence', true);
            }

            $declarations = $query->latest()->get();

            $declarationsMap = $declarations->map(function ($declaration) {
                return [
                    'id' => $declaration->id,
                    'latitude' => $declaration->latitude,
                    'longitude' => $declaration->longitude,
                    'description' => $declaration->description,
                    'urgence' => $declaration->urgence,
                    'statut' => $declaration->statut,
                    'infrastructure_type' => $declaration->infrastructure_type,
                    'created_at' => $declaration->created_at->format('d/m/Y H:i'),
                    'user_name' => $declaration->user->name ?? 'Anonyme',
                    'commune' => $declaration->commune->name ?? null,
                    'departement' => $declaration->departement->name ?? null,
                    'type' => 'general',
                    'has_images' => $declaration->media()->where('type', 'image')->exists(),
                    'has_videos' => $declaration->media()->where('type', 'video')->exists(),
                ];
            });

            return response()->json([
                'success' => true,
                'declarations' => $declarations,
                'declarationsMap' => $declarationsMap,
                'count' => $declarations->count()
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur filtrage déclarations: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Erreur lors du filtrage'], 500);
        }
    }

    /**
     * Applique le filtre selon le rôle de l'utilisateur
     */
    private function applyRoleFilter($query, $user)
    {
        switch ($user->role) {
            case 'prefet':
                if ($user->departement_id) {
                    $query->where('departement_id', $user->departement_id);
                }
                break;
            case 'maire':
                if ($user->commune_id) {
                    $query->where('commune_id', $user->commune_id);
                }
                break;
            case 'chef_arrondissement':
                if ($user->arrondissement_id) {
                    $query->where('arrondissement_id', $user->arrondissement_id);
                }
                break;
            default:
                // Pour les citoyens, déclarations proches
                $userLocation = $this->getUserLocation($user);
                if ($userLocation) {
                    $query->whereRaw("
                        (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * 
                        cos(radians(longitude) - radians(?)) + sin(radians(?)) * 
                        sin(radians(latitude)))) < 50
                    ", [$userLocation['lat'], $userLocation['lng'], $userLocation['lat']]);
                }
                break;
        }

        return $query;
    }

    /**
     * Méthodes helper pour la géolocalisation
     */
    private function getUserLocation($user)
    {
        // Implémentez la logique pour récupérer la localisation de l'utilisateur
        // Cela peut être depuis le profil utilisateur ou via géolocalisation
        return [
            'lat' => $user->last_latitude ?? 9.5,
            'lng' => $user->last_longitude ?? 2.25
        ];
    }

    private function getUserDepartementFromLocation($user)
    {
        $location = $this->getUserLocation($user);
        // Implémentez la logique pour trouver le département depuis les coordonnées
        return Departement::first(); // Exemple
    }

    private function getUserCommuneFromLocation($user)
    {
        $location = $this->getUserLocation($user);
        // Implémentez la logique pour trouver la commune depuis les coordonnées
        return Commune::first(); // Exemple
    }

    private function getUserArrondissementFromLocation($user){
        $location = $this->getUserLocation($user);
        // Implémentez la logique pour trouver l'arrondissement depuis les coordonnées
        return Arrondissement::first(); // Exemple
    }


    public function showDetails(Declaration $declaration){
        $declaration->load(['user', 'departement', 'commune', 'arrondissement', 'media', 'followers']);
        
        return view('declarations.partials.details-modal', compact('declaration'));
    }

    /**
     * Met à jour le statut d'une déclaration
     */
    public function updateStatus(Request $request, Declaration $declaration){
        try {
            $request->validate([
                'statut' => 'required|in:nouveau,en_cours,résolu'
            ]);

            $declaration->update([
                'statut' => $request->statut
            ]);

            // Log l'action
            Log::info('Statut déclaration mis à jour', [
                'declaration_id' => $declaration->id,
                'nouveau_statut' => $request->statut,
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Statut mis à jour avec succès',
                'statut' => $declaration->statut
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur mise à jour statut: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Erreur lors de la mise à jour'], 500);
        }
    }

}
