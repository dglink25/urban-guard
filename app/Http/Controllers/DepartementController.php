<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::with('prefect')->latest()->paginate(10);
        return view('departements.index', compact('departements'));
    }

    public function create()
    {
        return view('departements.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        Departement::create([
            'name' => $request->name,
            'id_prefect' => Auth::id(), // le user connecté devient créateur
        ]);

        return redirect()->route('departements.index')->with('success', 'Département ajouté avec succès.');
    }

    public function edit(Departement $departement)
    {
        return view('departements.edit', compact('departement'));
    }

    public function update(Request $request, Departement $departement)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $departement->update(['name' => $request->name]);
        return redirect()->route('departements.index')->with('success', 'Département mis à jour.');
    }

    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()->route('departements.index')->with('success', 'Département supprimé.');
    }
}
