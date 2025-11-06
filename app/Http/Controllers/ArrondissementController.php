<?php

namespace App\Http\Controllers;

use App\Models\Arrondissement;
use App\Models\Departement;
use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ArrondissementController extends Controller
{
    public function index()
    {
        $arrondissements = Arrondissement::with(['departement', 'commune'])->paginate(10);
        return view('arrondissements.index', compact('arrondissements'));
    }

    public function create()
    {
        $departements = Departement::all();
        $communes = Commune::all();
        return view('arrondissements.create', compact('departements', 'communes'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'id_departement' => 'required|exists:departements,id',
            'id_commune' => 'required|exists:communes,id',
        ]);

        // Création de l’arrondissement
        $arrondissement = Arrondissement::create([
            'name' => $request->name,
            'id_departement' => $request->id_departement,
            'id_commune' => $request->id_commune,
            'id_ca' => 1,
        ]);

        // Génération automatique de l’email du Chef d’Arrondissement
        $slug = \Illuminate\Support\Str::slug($request->name, '_');
        $email = strtolower($slug) . '@citinova.bj';

        // Création automatique du compte du Chef d’Arrondissement
        $user = User::create([
            'name' => 'Chef d’Arrondissement ' . $request->name,
            'email' => $email,
            'password' => Hash::make('citinova2025'),
            'role' => 'chef_arrondissement',
            'id_departement' => $request->id_departement,
            'id_commune' => $request->id_commune,
            'id_arrondissement' => $arrondissement->id,
        ]);

        // Mise à jour de l’arrondissement pour lier le CA
        $arrondissement->update([
            'id_ca' => $user->id,
        ]);

        return redirect()->route('arrondissements.index')
            ->with('success', 'Arrondissement et compte Chef d’Arrondissement ajoutés avec succès.');
    }


    public function edit(Arrondissement $arrondissement){
        $departements = Departement::all();
        $communes = Commune::all();
        return view('arrondissements.edit', compact('arrondissement', 'departements', 'communes'));
    }

    public function update(Request $request, Arrondissement $arrondissement){
        // 🧱 Validation
        $request->validate([
            'name' => 'required|string|max:255|unique:arrondissements,name,' . $arrondissement->id,
            'id_departement' => 'required|exists:departements,id',
            'id_commune' => 'required|exists:communes,id',
        ]);

        // 🔹 Génère le nouveau slug/email du chef
        $slug = \Illuminate\Support\Str::slug($request->name, '_');
        $newEmail = strtolower($slug) . '@citinova.bj';

        // Vérifie si l’email existe déjà chez un autre utilisateur
        $emailExists = \App\Models\User::where('email', $newEmail)
            ->where('id', '!=', optional($arrondissement->chef)->id)
            ->exists();

        if ($emailExists) {
            return back()
                ->withErrors(['name' => 'Ce nom génère un email déjà utilisé : ' . $newEmail])
                ->withInput();
        }

        // 🔹 Mise à jour de l’arrondissement
        $arrondissement->update([
            'name' => $request->name,
            'id_departement' => $request->id_departement,
            'id_commune' => $request->id_commune,
        ]);

        // 🔹 Si un chef est associé, on met aussi à jour son compte
        if ($arrondissement->chef) {
            $arrondissement->chef->update([
                'name' => 'Chef d’Arrondissement ' . $request->name,
                'email' => $newEmail,
                'id_departement' => $request->id_departement,
                'id_commune' => $request->id_commune,
            ]);
        }

        return redirect()->route('arrondissements.index')
            ->with('success', 'Arrondissement et compte Chef d’Arrondissement mis à jour avec succès.');
    }


    public function destroy(Arrondissement $arrondissement){
        // Vérifier s’il existe un Chef d’Arrondissement lié
        if ($arrondissement->chef) {
            $arrondissement->chef->delete(); // 🧹 Supprime le compte user associé
        }

        // Supprimer ensuite l’arrondissement
        $arrondissement->delete();

        return redirect()->route('arrondissements.index')
            ->with('success', 'Arrondissement et compte Chef d’Arrondissement supprimés avec succès.');
    }

}
