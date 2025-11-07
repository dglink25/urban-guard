<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\ArrondissementController;
use App\Http\Controllers\QuartierController;
use App\Models\Arrondissement;
use App\Models\Commune;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\UserValidationController;
use App\Models\Quartier;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrefetController;
use App\Http\Controllers\MaireController;
use App\Http\Controllers\CAController;
use App\Http\Controllers\DeclarationController;


Route::get('/api/communes/{departement}', function ($departementId) {
    return Commune::where('id_departement', $departementId)->select('id', 'name')->get();
});

Route::get('/api/arrondissements/{commune}', function ($communeId) {
    return Arrondissement::where('id_commune', $communeId)->select('id', 'name')->get();
});

Route::get('/api/quartiers/{arrondissement}', function ($arrondissementId) {
    return Quartier::where('id_arrondissement', $arrondissementId)->select('id', 'name')->get();
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/demandes', [UserValidationController::class, 'index'])->name('admin.users.index');
    Route::post('/demandes/{user}/approve', [UserValidationController::class, 'approve'])->name('admin.users.approve');
    Route::post('/demandes/{user}/reject', [UserValidationController::class, 'reject'])->name('admin.users.reject');
});

// Route pour le tableau de bord des déclarations
Route::get('/dashboard/declarations', [DashboardController::class, 'defaut'])->name('dashboard.declarations');
Route::get('/api/declarations/filter', [DashboardController::class, 'filterDeclarations'])->name('api.declarations.filter');
Route::patch('/declarations/{declaration}/status', [DeclarationController::class, 'updateStatus'])->name('declarations.updateStatus');
Route::get('/declarations/{declaration}/details', [DeclarationController::class, 'showDetails'])->name('declarations.details');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {
    Route::resource('departements', DepartementController::class);
    Route::resource('communes', CommuneController::class);
    Route::resource('arrondissements', ArrondissementController::class);
    Route::resource('quartiers', QuartierController::class);
});

Route::get('/communes/by-departement/{id}', function ($id) {
    return Commune::where('id_departement', $id)->select('id', 'name')->get();
})->name('communes.by-departement');

Route::get('/communes/by-departement/{id}', function ($id) {
    return Commune::where('id_departement', $id)->select('id', 'name')->get();
})->name('communes.by-departement');

Route::get('/arrondissements/by-commune/{id}', function ($id) {
    return Arrondissement::where('id_commune', $id)->select('id', 'name')->get();
})->name('arrondissements.by-commune');

Route::get('/communes/{commune}', [CommuneController::class, 'show'])->name('communes.show');

Route::get('/departements/{departement}', [DepartementController::class, 'show'])->name('departements.show');

Route::middleware(['auth'])->group(function () {

    /** PRÉFET */
    Route::get('/prefet/communes', [PrefetController::class, 'communes'])->name('prefet.communes');
    Route::get('/prefet/statistiques', [PrefetController::class, 'stats'])->name('prefet.stats');

    /** MAIRE */
    Route::get('/maire/arrondissements', [MaireController::class, 'arrondissements'])->name('maire.arrondissements');
    Route::get('/maire/statistiques', [MaireController::class, 'stats'])->name('maire.stats');

    /** CHEF D’ARRONDISSEMENT */
    Route::get('/ca/statistiques', [CAController::class, 'stats'])->name('ca.stats');
});
