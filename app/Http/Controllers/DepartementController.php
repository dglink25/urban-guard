<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DepartementController extends Controller{
    public function index()
    {
        $departements = Departement::with('prefect')->latest()->paginate(10);
        return view('departements.index', compact('departements'));
    }

    public function create()
    {
        return view('departements.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Création du département
        $departement = Departement::create([
            'name' => $request->name,
            'id_prefect' => Auth::id(),
        ]);

        // Création du compte préfet associé
        $slug = Str::slug($request->name, '_'); // rend le nom plus propre pour l'email
        $email = strtolower($slug) . '@citinova.bj';

        $user = User::create([
            'name' => 'Préfet ' . $request->name,
            'email' => $email,
            'password' => Hash::make('citinova2025'),
            'role' => 'prefet',
            'id_departement' => $departement->id, // ici, on utilise bien la variable créée
        ]);

        return redirect()->route('departements.index')
            ->with('success', 'Département ajouté avec succès.');
    }


    public function edit(Departement $departement){
        return view('departements.edit', compact('departement'));
    }

    public function update(Request $request, Departement $departement){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Mise à jour du département
        $departement->update([
            'name' => $request->name,
        ]);

        // Récupération du préfet associé
        $prefet = $departement->prefet ?? null;

        if ($prefet) {
            // Génère un slug propre pour l'email
            $slug = \Illuminate\Support\Str::slug($request->name, '_');
            $email = strtolower($slug) . '@citinova.bj';

            // Mise à jour des informations du préfet
            $prefet->update([
                'name' => 'Préfet ' . $request->name,
                'email' => $email,
            ]);
        }

        return redirect()->route('departements.index')
            ->with('success', 'Département mis à jour avec succès.');
    }


    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()->route('departements.index')->with('success', 'Département supprimé.');
    }
}
