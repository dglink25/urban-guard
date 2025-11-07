<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\Departement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CommuneController extends Controller
{
    public function index()
    {
        $communes = Commune::with('departement', 'maire')->latest()->paginate(10);
        return view('communes.index', compact('communes'));
    }

    public function create()
    {       
        $departements = Departement::all();
        return view('communes.create', compact('departements'));
    }

    public function store(Request $request){
        $request->validate([
            'name'           => 'required|string|max:255',
            'id_departement' => 'required|exists:departements,id',
        ]);
        

        try {
            DB::beginTransaction();

            // Création de la commune
            $commune = Commune::create([
                'name'           => $request->name,
                'id_departement' => $request->id_departement,
                'id_maire'       => 1,
            ]);
            
            // Génération d’un email pour le maire
            $slug  = Str::slug($request->name, '_');
            $email = strtolower($slug) . '@citinova.bj';

            // Vérifier unicité du mail
            if (User::where('email', $email)->exists()) {
                throw new \Exception("L'adresse e-mail générée ($email) existe déjà. Veuillez choisir un autre nom de commune.");
            }

            // Création du compte maire
            $user = User::create([
                'name'           => 'Maire ' . $request->name,
                'email'          => $email,
                'password'       => Hash::make('citinova2025'),
                'role'           => 'maire',
                'id_departement' => $request->id_departement,
                'id_commune'     => $commune->id,
            ]);

            // Associer le maire à la commune
            $commune->update(['id_maire' => $user->id]);

            DB::commit();

            return redirect()->route('communes.index')
                ->with('success', 'Commune et compte du maire créés avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création de la commune : ' . $e->getMessage());
        }
    }

    public function edit(Commune $commune)
    {
        $departements = Departement::all();
        return view('communes.edit', compact('commune', 'departements'));
    }

    public function update(Request $request, Commune $commune)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'id_departement' => 'required|exists:departements,id',
        ]);

        try {
            DB::beginTransaction();

            // Mise à jour commune
            $commune->update([
                'name'           => $request->name,
                'id_departement' => $request->id_departement,
            ]);

            // Récupération du maire
            $maire = $commune->maire;
            if ($maire) {
                $slug  = Str::slug($request->name, '_');
                $email = strtolower($slug) . '@citinova.bj';

                // Vérifier que l’email n’est pas déjà pris par un autre utilisateur
                if (User::where('email', $email)->where('id', '!=', $maire->id)->exists()) {
                    throw new \Exception("L'adresse e-mail générée ($email) est déjà utilisée par un autre utilisateur.");
                }

                $maire->update([
                    'name'           => 'Maire ' . $request->name,
                    'email'          => $email,
                    'id_departement' => $request->id_departement,
                ]);
            }

            DB::commit();

            return redirect()->route('communes.index')
                ->with('success', 'Commune et compte du maire mis à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    public function destroy(Commune $commune)
    {
        try {
            DB::beginTransaction();

            // Supprimer le maire lié (si existe)
            if ($commune->maire) {
                $commune->maire->delete();
            }

            // Supprimer la commune
            $commune->delete();

            DB::commit();

            return redirect()->route('communes.index')
                ->with('success', 'Commune et compte du maire supprimés avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('communes.index')
                ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }

    public function show($id){
        $commune = \App\Models\Commune::with([
            'maire',
            'arrondissements.ca'
        ])->findOrFail($id);

        $nombreArrondissements = $commune->arrondissements->count();

        return view('communes.show', compact('commune', 'nombreArrondissements'));
    }

}
