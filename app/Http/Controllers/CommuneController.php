<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommuneController extends Controller
{
    public function index()
    {
        $communes = Commune::with('departement')->latest()->paginate(10);
        return view('communes.index', compact('communes'));
    }

    public function create()
    {
        $departements = Departement::all();
        return view('communes.create', compact('departements'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'id_departement' => 'required|exists:departements,id',
        ]);

        // Création de la commune
        $commune = Commune::create([
            'name' => $request->name,
            'id_departement' => $request->id_departement,
            'id_maire' => Auth::id(), // l’utilisateur connecté devient le créateur
        ]);

        // Génération d’un email pour le maire
        $slug = \Illuminate\Support\Str::slug($request->name, '_');
        $email = strtolower($slug) . '@citinova.bj';

        // Création automatique du compte du maire
        $user = User::create([
            'name' => 'Maire ' . $request->name,
            'email' => $email,
            'password' => Hash::make('citinova2025'),
            'role' => 'maire',
            'id_departement' => $request->id_departement,
            'id_commune' => $commune->id, // lien avec la commune créée
        ]);

        return redirect()->route('communes.index')
            ->with('success', 'Commune et compte maire ajoutés avec succès.');
    }



    public function edit(Commune $commune){
        $departements = Departement::all();
        return view('communes.edit', compact('commune', 'departements'));
    }

    public function update(Request $request, Commune $commune){
        $request->validate([
            'name' => 'required|string|max:255',
            'id_departement' => 'required|exists:departements,id',
        ]);

        // Mise à jour des infos de la commune
        $commune->update([
            'name' => $request->name,
            'id_departement' => $request->id_departement,
        ]);

        // Récupération du maire associé (relation dans le modèle Commune)
        $maire = $commune->maire ?? null;

        if ($maire) {
            // Génère un slug propre pour le mail
            $slug = \Illuminate\Support\Str::slug($request->name, '_');
            $email = strtolower($slug) . '@citinova.bj';

            // Mise à jour du compte du maire
            $maire->update([
                'name' => 'Maire ' . $request->name,
                'email' => $email,
            ]);
        }

        return redirect()->route('communes.index')
            ->with('success', 'Commune mise à jour avec succès.');
    }


    public function destroy(Commune $commune)
    {
        $commune->delete();
        return redirect()->route('communes.index')->with('success', 'Commune supprimée.');
    }
}
