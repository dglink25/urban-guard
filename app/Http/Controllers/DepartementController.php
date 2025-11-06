<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::with('prefet')->latest()->paginate(10);
        return view('departements.index', compact('departements'));
    }

    public function create()
    {
        return view('departements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departements,name',
        ]);

        try {
            DB::beginTransaction();

            // Création du département
            $departement = Departement::create([
                'name' => $request->name,
                'id_prefet' => null,
            ]);

            // Génération d’un email unique
            $slug  = Str::slug($request->name, '_');
            $email = strtolower($slug) . '@citinova.bj';

            // Vérifier si l’email est déjà utilisé
            if (User::where('email', $email)->exists()) {
                throw new \Exception("L'adresse e-mail générée ($email) existe déjà. Veuillez choisir un autre nom de département.");
            }

            // Création du compte préfet
            $user = User::create([
                'name'           => 'Préfet ' . $request->name,
                'email'          => $email,
                'password'       => Hash::make('citinova2025'),
                'role'           => 'prefet',
                'id_departement' => $departement->id,
            ]);

            // Mise à jour du département
            $departement->update([
                'id_prefet' => $user->id,
            ]);

            DB::commit();

            return redirect()->route('departements.index')
                ->with('success', 'Département et compte préfet créés avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création : ' . $e->getMessage());
        }
    }

    public function edit(Departement $departement)
    {
        return view('departements.edit', compact('departement'));
    }

    public function update(Request $request, Departement $departement)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departements,name,' . $departement->id,
        ]);

        try {
            DB::beginTransaction();

            // Mise à jour du département
            $departement->update([
                'name' => $request->name,
            ]);

            // Récupération du préfet
            $prefet = $departement->prefet ?? null;

            if ($prefet) {
                $slug  = Str::slug($request->name, '_');
                $email = strtolower($slug) . '@citinova.bj';

                // Vérifier que l’email n’est pas déjà pris par un autre utilisateur
                if (User::where('email', $email)->where('id', '!=', $prefet->id)->exists()) {
                    throw new \Exception("L'adresse e-mail générée ($email) est déjà utilisée par un autre utilisateur.");
                }

                // Mise à jour du compte préfet
                $prefet->update([
                    'name'  => 'Préfet ' . $request->name,
                    'email' => $email,
                ]);
            }

            DB::commit();

            return redirect()->route('departements.index')
                ->with('success', 'Département et compte préfet mis à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    public function destroy(Departement $departement){
        try {
            DB::beginTransaction();

            // Supprimer le préfet lié (si existe)
            if ($departement->prefet) {
                $departement->prefet->delete();
            }

            // Supprimer le département
            $departement->delete();

            DB::commit();

            return redirect()->route('departements.index')
                ->with('success', 'Département et compte préfet supprimés avec succès.');
        } 
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('departements.index')
                ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }

    public function show($id){
        $departement = \App\Models\Departement::with([
            'prefet',
            'communes.maire'
        ])->findOrFail($id);

        $nombreCommunes = $departement->communes->count();

        return view('departements.show', compact('departement', 'nombreCommunes'));
    }

}
