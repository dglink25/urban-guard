<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRejectedMail;
use App\Mail\UserValidatedMail;

class UserValidationController extends Controller{
    public function index(){
        $users = User::where('status', 'pending')->get();
        return view('admin.users.index', compact('users'));
    }

    public function approve(User $user){
        $user->update(['status' => 'approved']);

        // Notification au demandeur
        Mail::to($user->email)->send(new UserValidatedMail($user));

        return back()->with('success', 'Utilisateur approuvé avec succès.');
    }

    public function reject(User $user){
        $user->update(['status' => 'rejected']);
        Mail::to($user->email)->send(new UserRejectedMail($user));

        return back()->with('error', 'Utilisateur rejeté.');
    }
}
