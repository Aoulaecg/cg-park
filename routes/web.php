<?php

use App\Http\Controllers\Admin\AppelOffreController as AdminAppelOffreController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ParkingController as AdminParkingController;
use App\Http\Controllers\AppelsOffresController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MetiersController;
use Illuminate\Support\Facades\Route;

// ─── Site public ────────────────────────────────────────────────────────────

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/gouvernance', function () {
    return view('gouvernance');
})->name('gouvernance');

Route::get('/a-propos', function () {
    return view('a-propos');
})->name('apropos');

Route::get('/mentions-legales', function () {
    return view('mentions-legales');
})->name('mentions-legales');

Route::get('/appels-offres-et-consultation', [AppelsOffresController::class, 'index'])->name('appels-offres.index');

Route::get('/nos-metiers', [MetiersController::class, 'index'])->name('metiers.index');
Route::get('/villes/{slug}', [MetiersController::class, 'city'])->name('villes.show');
Route::get('/parkings/{slug}', [MetiersController::class, 'parking'])->name('parkings.show');

Route::get('/locale/{locale}', [LocaleController::class, 'update'])->name('locale.switch');

// ─── Téléchargement de fichiers ────────────────────────────────────────────

Route::get('/appels-offres/download/{appel}', [AppelsOffresController::class, 'download'])->name('appels-offres.download');

// ─── Console admin ──────────────────────────────────────────────────────────

Route::prefix('console')->name('console.')->group(function () {

    // Authentification (non protégée)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Routes protégées par le middleware admin
    Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Gestion des parkings
        Route::resource('parkings', AdminParkingController::class)
            ->names([
                'index'   => 'parkings.index',
                'create'  => 'parkings.create',
                'store'   => 'parkings.store',
                'edit'    => 'parkings.edit',
                'update'  => 'parkings.update',
                'destroy' => 'parkings.destroy',
            ]);

        // Gestion des appels d'offres
        Route::resource('appels-offres', AdminAppelOffreController::class)
            ->names([
                'index'   => 'appels-offres.index',
                'create'  => 'appels-offres.create',
                'store'   => 'appels-offres.store',
                'edit'    => 'appels-offres.edit',
                'update'  => 'appels-offres.update',
                'destroy' => 'appels-offres.destroy',
            ]);

        // Téléchargement de fichiers
        Route::get('appels-offres/{appelsOffre}/download', [AdminAppelOffreController::class, 'download'])
            ->name('appels-offres.download');
    });
});
