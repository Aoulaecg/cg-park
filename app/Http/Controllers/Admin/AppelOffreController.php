<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAppelOffreRequest;
use App\Models\AppelOffre;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AppelOffreController extends Controller
{
    public function index(): View
    {
        $search = request('search');
        $statut = request('statut');

        $appels = AppelOffre::query()
            ->when($search, fn ($q) => $q->where('titre', 'like', "%{$search}%")
                ->orWhere('numero', 'like', "%{$search}%")
                ->orWhere('objet',  'like', "%{$search}%"))
            ->when($statut, fn ($q) => $q->where('statut', $statut))
            ->orderBy('sort_order')
            ->orderByDesc('date_publication')
            ->paginate(15)
            ->withQueryString();

        return view('admin.appels-offres.index', compact('appels'));
    }

    public function create(): View
    {
        return view('admin.appels-offres.form');
    }

    public function store(StoreAppelOffreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');
            $data['fichier_path'] = $file->store('appels-offres', 'public');
            $data['fichier_nom']  = $file->getClientOriginalName();
        }

        AppelOffre::create($data);

        return redirect()->route('console.appels-offres.index')
            ->with('success', 'Appel d\'offres créé avec succès.');
    }

    public function edit(AppelOffre $appelsOffre): View
    {
        return view('admin.appels-offres.form', ['appel' => $appelsOffre]);
    }

    public function update(StoreAppelOffreRequest $request, AppelOffre $appelsOffre): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('fichier')) {
            if ($appelsOffre->fichier_path) {
                Storage::disk('public')->delete($appelsOffre->fichier_path);
            }
            $file = $request->file('fichier');
            $data['fichier_path'] = $file->store('appels-offres', 'public');
            $data['fichier_nom']  = $file->getClientOriginalName();
        }

        $appelsOffre->update($data);

        return redirect()->route('console.appels-offres.index')
            ->with('success', 'Appel d\'offres mis à jour avec succès.');
    }

    public function destroy(AppelOffre $appelsOffre): RedirectResponse
    {
        if ($appelsOffre->fichier_path) {
            Storage::disk('public')->delete($appelsOffre->fichier_path);
        }

        $appelsOffre->delete();

        return redirect()->route('console.appels-offres.index')
            ->with('success', 'Appel d\'offres supprimé avec succès.');
    }
}
