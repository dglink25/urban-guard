<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PrefetController extends Controller
{
    // Liste des communes du département du préfet connecté
    public function communes()
    {
        $user = Auth::user();
        $communes = Commune::where('id_departement', $user->id_departement)->with('maire')->get();

        return view('prefet.communes', compact('communes'));
    }

    // Statistiques globales du département
    public function stats()
    {
        $user = Auth::user();
        $communesCount = \App\Models\Commune::where('id_departement', $user->id_departement)->count();
        $arrondissementsCount = \App\Models\Arrondissement::where('id_departement', $user->id_departement)->count();

        return view('prefet.stats', compact('communesCount', 'arrondissementsCount'));
    }
}
