<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CAController extends Controller
{
    // Statistiques de l’arrondissement du CA connecté
    public function stats()
    {
        $user = Auth::user();

        $citoyensCount = \App\Models\User::where('id_arrondissement', $user->id_arrondissement)
            ->where('role', 'citoyen')
            ->count();

        $quartiersCount = \App\Models\Quartier::where('id_arrondissement', $user->id_arrondissement)->count();

        return view('ca.stats', compact('citoyensCount', 'quartiersCount'));
    }
}
