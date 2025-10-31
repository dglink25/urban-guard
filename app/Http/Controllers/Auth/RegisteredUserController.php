<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Departement;
use App\Models\Commune;
use App\Models\Arrondissement;
use App\Models\Quartier;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\NewRegistrationAdminMail;
use App\Mail\RegistrationPendingUserMail;

class RegisteredUserController extends Controller
{
    /**
     * Afficher la vue d'inscription
     */
    public function create(): View
    {
        $departements = Departement::all();
        $communes = Commune::all();
        $arrondissements = Arrondissement::all();
        $quartiers = Quartier::all();

        return view('auth.register', compact('departements', 'communes', 'arrondissements', 'quartiers'));
    }

    /**
     * Traiter la demande d'inscription
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password'          => ['required', 'confirmed', Rules\Password::defaults()],
            'id_departement'    => ['required', 'exists:departements,id'],
            'id_commune'        => ['required', 'exists:communes,id'],
            'id_arrondissement' => ['required', 'exists:arrondissements,id'],
            'id_quartier'       => ['required', 'exists:quartiers,id'],
            'rue'               => ['required', 'string', 'max:255'],
            'maison'            => ['required', 'string', 'max:255'],
            'role'              => ['required', 'in:prefet,maire,ca,cq,conseiller'],
        ]);

        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'id_departement'    => $request->id_departement,
            'id_commune'        => $request->id_commune,
            'id_arrondissement' => $request->id_arrondissement,
            'id_quartier'       => $request->id_quartier,
            'rue'               => $request->rue,
            'maison'            => $request->maison,
            'role'              => $request->role,
            'status'            => 'pending', // statut par défaut
        ]);

        Mail::to('dondiegue21@gmail.com')->send(new NewRegistrationAdminMail($user));
        Mail::to($user->email)->send(new RegistrationPendingUserMail($user));


        event(new Registered($user));

        // Connexion automatique
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
