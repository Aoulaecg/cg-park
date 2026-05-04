<?php

namespace App\Http\Controllers;

use App\Models\AppelOffre;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function download(AppelOffre $appel): StreamedResponse
    {
        abort_unless($appel->fichier_path, 404);

        $filePath = $appel->fichier_path;
        $fileName = $appel->fichier_nom ?? basename($filePath);

        return Storage::disk('public')->download($filePath, $fileName);
    }
}
