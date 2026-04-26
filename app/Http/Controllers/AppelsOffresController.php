<?php

namespace App\Http\Controllers;

use App\Models\AppelOffre;
use Illuminate\Contracts\View\View;

class AppelsOffresController extends Controller
{
    public function index(): View
    {
        $appels = AppelOffre::orderBy('sort_order')
            ->orderByDesc('date_publication')
            ->get();

        $regulationPath = 'documents/Reglement-des-achats-CGPark.pdf';

        return view('appels-offres', compact('appels', 'regulationPath'));
    }
}
