<?php

namespace App\Http\Controllers;

use App\Models\Quartier;
use App\Models\Departement;
use App\Models\Commune;
use App\Models\Arrondissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuartierController extends Controller
{
    public function index()
    {
        $quartiers = Quartier::with(['departement', 'commune', 'arrondissement'])->paginate(10);
        return view('quartiers.index', compact('quartiers'));
    }

    public function create()
    {
        $departements = Departement::all();
        $communes = Commune::all();
        $arrondissements = Arrondissement::all();
        return view('quartiers.create', compact('departements', 'communes', 'arrondissements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'liens_google_maps' => 'nullable|string',
            'id_departement' => 'required|exists:departements,id',
            'id_commune' => 'required|exists:communes,id',
            'id_arrondissement' => 'required|exists:arrondissements,id',
        ]);

        Quartier::create([
            'name' => $request->name,
            'liens_google_maps' => $request->liens_google_maps,
            'id_departement' => $request->id_departement,
            'id_commune' => $request->id_commune,
            'id_arrondissement' => $request->id_arrondissement,
            'id_cq' => Auth::id(),
        ]);

        return redirect()->route('quartiers.index')->with('success', 'Quartier ajouté.');
    }

    public function edit(Quartier $quartier)
    {
        $departements = Departement::all();
        $communes = Commune::all();
        $arrondissements = Arrondissement::all();
        return view('quartiers.edit', compact('quartier', 'departements', 'communes', 'arrondissements'));
    }

    public function update(Request $request, Quartier $quartier)
    {
        $request->validate([
            'name' => 'required',
            'liens_google_maps' => 'nullable|string',
            'id_departement' => 'required|exists:departements,id',
            'id_commune' => 'required|exists:communes,id',
            'id_arrondissement' => 'required|exists:arrondissements,id',
        ]);

        $quartier->update($request->all());
        return redirect()->route('quartiers.index')->with('success', 'Quartier mis à jour.');
    }

    public function destroy(Quartier $quartier)
    {
        $quartier->delete();
        return redirect()->route('quartiers.index')->with('success', 'Quartier supprimé.');
    }
}
