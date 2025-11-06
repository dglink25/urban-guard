<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 👇 On charge la vue correspondant au rôle
        switch ($user->role) {
            case 'admin':
                return view('dashboard.admin', compact('user'));

            case 'prefet':
                return view('dashboard.prefet', compact('user'));

            case 'maire':
                return view('dashboard.maire', compact('user'));

            case 'chef_arrondissement':
                return view('dashboard.ca', compact('user'));

            default:
                return view('dashboard.default', compact('user'));
        }
    }
}
