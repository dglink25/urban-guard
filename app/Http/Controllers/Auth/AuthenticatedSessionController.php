<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Affiche la page de connexion.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Traite la connexion.
     */
    public function store(LoginRequest $request): RedirectResponse{
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // 🔒 Redirection intelligente selon le rôle
        if ($user->role === 'admin') {
            return redirect()->route('dashboard')->with('success', 'Bienvenue Administrateur');
        }

        if ($user->role === 'prefet') {
            return redirect()->route('dashboard')->with('success', 'Bienvenue dans votre département');
        }

        if ($user->role === 'maire') {
            return redirect()->route('dashboard')->with('success', 'Bienvenue Monsieur le Maire');
        }

        if ($user->role === 'chef_arrondissement') {
            return redirect()->route('dashboard')->with('success', 'Bienvenue Chef d’Arrondissement');
        }

        // Par défaut (si le rôle n'est pas reconnu)
        return redirect()->route('dashboard')->with('info', 'Bienvenue sur votre espace.');
    }

    /**
     * Déconnexion.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Déconnexion réussie');
    }
}
