<?php

namespace App\Http\Controllers;

use App\Models\Arrondissement;
use App\Models\Departement;
use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id_departement' => 'required|exists:departements,id',
            'id_commune' => 'required|exists:communes,id'
        ]);

        Arrondissement::create([
            'name' => $request->name,
            'id_departement' => $request->id_departement,
            'id_commune' => $request->id_commune,
            'id_ca' => Auth::id()
        ]);

        return redirect()->route('arrondissements.index')->with('success', 'Arrondissement ajouté.');
    }

    public function edit(Arrondissement $arrondissement)
    {
        $departements = Departement::all();
        $communes = Commune::all();
        return view('arrondissements.edit', compact('arrondissement', 'departements', 'communes'));
    }

    public function update(Request $request, Arrondissement $arrondissement)
    {
        $request->validate([
            'name' => 'required',
            'id_departement' => 'required|exists:departements,id',
            'id_commune' => 'required|exists:communes,id'
        ]);

        $arrondissement->update([
            'name' => $request->name,
            'id_departement' => $request->id_departement,
            'id_commune' => $request->id_commune
        ]);

        return redirect()->route('arrondissements.index')->with('success', 'Arrondissement mis à jour.');
    }

    public function destroy(Arrondissement $arrondissement)
    {
        $arrondissement->delete();
        return redirect()->route('arrondissements.index')->with('success', 'Arrondissement supprimé.');
    }
}
