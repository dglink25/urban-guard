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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_departement' => 'required|exists:departements,id'
        ]);

        Commune::create([
            'name' => $request->name,
            'id_departement' => $request->id_departement,
            'id_maire' => Auth::id()
        ]);

        return redirect()->route('communes.index')->with('success', 'Commune ajoutée avec succès.');
    }

    public function edit(Commune $commune)
    {
        $departements = Departement::all();
        return view('communes.edit', compact('commune', 'departements'));
    }

    public function update(Request $request, Commune $commune)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_departement' => 'required|exists:departements,id'
        ]);

        $commune->update([
            'name' => $request->name,
            'id_departement' => $request->id_departement,
        ]);

        return redirect()->route('communes.index')->with('success', 'Commune mise à jour.');
    }

    public function destroy(Commune $commune)
    {
        $commune->delete();
        return redirect()->route('communes.index')->with('success', 'Commune supprimée.');
    }
}
