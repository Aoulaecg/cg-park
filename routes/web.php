<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MetiersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/gouvernance', function () {
    return view('gouvernance');
})->name('gouvernance');

Route::get('/a-propos', function () {
    return view('a-propos');
})->name('apropos');

Route::view('/appels-offres-et-consultation', 'appels-offres')->name('appels-offres.index');

Route::get('/nos-metiers', [MetiersController::class, 'index'])->name('metiers.index');
Route::get('/villes/{slug}', [MetiersController::class, 'city'])->name('villes.show');
Route::get('/parkings/{slug}', [MetiersController::class, 'parking'])->name('parkings.show');

Route::get('/locale/{locale}', [LocaleController::class, 'update'])->name('locale.switch');
