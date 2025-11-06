<?php

namespace App\Http\Controllers;

use App\Models\Arrondissement;
use Illuminate\Support\Facades\Auth;

class MaireController extends Controller
{
    // Liste des arrondissements de la commune du maire connecté
    public function arrondissements()
    {
        $user = Auth::user();
        $arrondissements = Arrondissement::where('id_commune', $user->id_commune)->with('chef')->get();

        return view('maire.arrondissements', compact('arrondissements'));
    }

    // Statistiques de la commune
    public function stats()
    {
        $user = Auth::user();
        $arrondissementsCount = Arrondissement::where('id_commune', $user->id_commune)->count();
        $citoyensCount = \App\Models\User::where('id_commune', $user->id_commune)
            ->where('role', 'citoyen')
            ->count();

        return view('maire.stats', compact('arrondissementsCount', 'citoyensCount'));
    }
}
