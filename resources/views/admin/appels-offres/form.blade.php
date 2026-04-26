@extends('admin.layouts.admin')

@section('page_title', isset($appel) ? "Modifier l'appel d'offres" : "Ajouter un appel d'offres")

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-header-title">
                {{ isset($appel) ? 'Modifier : ' . ($appel->numero ?? $appel->titre) : "Ajouter un appel d'offres" }}
            </h1>
            <p class="page-header-sub">
                <a href="{{ route('console.appels-offres.index') }}" style="color:var(--text-muted);text-decoration:none;">← Retour à la liste</a>
            </p>
        </div>
    </div>

    <div class="admin-card">
        <form
            action="{{ isset($appel) ? route('console.appels-offres.update', $appel) : route('console.appels-offres.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @if (isset($appel))
                @method('PUT')
            @endif

            <div class="form-grid">

                {{-- Titre --}}
                <div class="form-group form-grid-full">
                    <label for="titre" class="form-label">Titre <span class="required">*</span></label>
                    <input type="text" id="titre" name="titre"
                           class="form-control {{ $errors->has('titre') ? 'is-invalid' : '' }}"
                           value="{{ old('titre', $appel->titre ?? '') }}" required>
                    @error('titre')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Numéro --}}
                <div class="form-group">
                    <label for="numero" class="form-label">Numéro de l'appel d'offres</label>
                    <input type="text" id="numero" name="numero"
                           class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}"
                           value="{{ old('numero', $appel->numero ?? '') }}"
                           placeholder="ex: 003/2026">
                    @error('numero')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Statut --}}
                <div class="form-group">
                    <label for="statut" class="form-label">Statut <span class="required">*</span></label>
                    <select id="statut" name="statut"
                            class="form-control {{ $errors->has('statut') ? 'is-invalid' : '' }}" required>
                        <option value="ouvert"  {{ old('statut', $appel->statut ?? 'ouvert') === 'ouvert'  ? 'selected' : '' }}>Ouvert</option>
                        <option value="ferme"   {{ old('statut', $appel->statut ?? '') === 'ferme'   ? 'selected' : '' }}>Fermé</option>
                        <option value="archive" {{ old('statut', $appel->statut ?? '') === 'archive' ? 'selected' : '' }}>Archivé</option>
                    </select>
                    @error('statut')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Objet --}}
                <div class="form-group form-grid-full">
                    <label for="objet" class="form-label">Objet <span class="required">*</span></label>
                    <textarea id="objet" name="objet" rows="3"
                              class="form-control {{ $errors->has('objet') ? 'is-invalid' : '' }}"
                              required>{{ old('objet', $appel->objet ?? '') }}</textarea>
                    @error('objet')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Description --}}
                <div class="form-group form-grid-full">
                    <label for="description" class="form-label">Description courte</label>
                    <textarea id="description" name="description" rows="3"
                              class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $appel->description ?? '') }}</textarea>
                    @error('description')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Date publication --}}
                <div class="form-group">
                    <label for="date_publication" class="form-label">Date de publication</label>
                    <input type="date" id="date_publication" name="date_publication"
                           class="form-control {{ $errors->has('date_publication') ? 'is-invalid' : '' }}"
                           value="{{ old('date_publication', isset($appel) && $appel->date_publication ? $appel->date_publication->format('Y-m-d') : '') }}">
                    @error('date_publication')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Date limite --}}
                <div class="form-group">
                    <label for="date_limite" class="form-label">Date limite</label>
                    <input type="date" id="date_limite" name="date_limite"
                           class="form-control {{ $errors->has('date_limite') ? 'is-invalid' : '' }}"
                           value="{{ old('date_limite', isset($appel) && $appel->date_limite ? $appel->date_limite->format('Y-m-d') : '') }}">
                    @error('date_limite')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Fichier --}}
                <div class="form-group form-grid-full">
                    <label for="fichier" class="form-label">Document (PDF, DOC, DOCX)</label>
                    @if (isset($appel) && $appel->fichier_path)
                        <div style="margin-bottom:10px;padding:12px 16px;background:#f8fafc;border-radius:8px;border:1px solid var(--border);">
                            <span style="font-size:0.82rem;color:var(--text-muted);">Fichier actuel : </span>
                            <a href="{{ Storage::url($appel->fichier_path) }}" target="_blank"
                               style="font-size:0.88rem;font-weight:600;color:var(--accent);">
                                {{ $appel->fichier_nom ?? $appel->fichier_path }}
                            </a>
                            <span style="font-size:0.78rem;color:var(--text-muted);margin-left:8px;">— téléversez un nouveau fichier pour le remplacer.</span>
                        </div>
                    @endif
                    <input type="file" id="fichier" name="fichier"
                           class="form-control {{ $errors->has('fichier') ? 'is-invalid' : '' }}"
                           accept=".pdf,.doc,.docx">
                    @error('fichier')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Ordre --}}
                <div class="form-group">
                    <label for="sort_order" class="form-label">Ordre d'affichage</label>
                    <input type="number" id="sort_order" name="sort_order" min="0"
                           class="form-control {{ $errors->has('sort_order') ? 'is-invalid' : '' }}"
                           value="{{ old('sort_order', $appel->sort_order ?? 0) }}">
                    @error('sort_order')<span class="form-error">{{ $message }}</span>@enderror
                </div>

            </div>

            <div style="display:flex;gap:12px;margin-top:28px;padding-top:24px;border-top:1px solid var(--border);">
                <button type="submit" class="btn btn-primary">
                    {{ isset($appel) ? 'Enregistrer les modifications' : "Créer l'appel d'offres" }}
                </button>
                <a href="{{ route('console.appels-offres.index') }}" class="btn btn-outline">Annuler</a>
            </div>
        </form>
    </div>
@endsection
