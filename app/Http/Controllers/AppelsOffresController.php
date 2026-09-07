<?php

namespace App\Http\Controllers;

use App\Models\AppelOffre;
use App\Models\AppelOffreDownload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
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

    public function download(
        Request $request,
        AppelOffre $appel
    ): StreamedResponse {
        $validated = $request->validate([
            'company_name' => [
                'required',
                'string',
                'max:255',
            ],
        ], [
            'company_name.required' => 'Le nom de la société est obligatoire.',
            'company_name.max' => 'Le nom de la société ne doit pas dépasser 255 caractères.',
        ]);

        abort_unless($appel->fichier_path, 404);

        $filePath = $appel->fichier_path;
        $fileName = $appel->fichier_nom ?? basename($filePath);

        abort_unless(
            Storage::disk('public')->exists($filePath),
            404,
            'Le fichier demandé est introuvable.'
        );

        AppelOffreDownload::create([
            'appel_offre_id' => $appel->id,
            'company_name' => $validated['company_name'],
        ]);

        $appel->increment('download_count');

        return Storage::disk('public')->download(
            $filePath,
            $fileName
        );
    }
}