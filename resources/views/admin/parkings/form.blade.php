@extends('admin.layouts.admin')

@section('page_title', isset($parking) ? 'Modifier le parking' : 'Ajouter un parking')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-header-title">{{ isset($parking) ? 'Modifier : ' . $parking->name : 'Ajouter un parking' }}</h1>
            <p class="page-header-sub">
                <a href="{{ route('console.parkings.index') }}" style="color:var(--text-muted);text-decoration:none;">← Retour à la liste</a>
            </p>
        </div>
    </div>

    <div class="admin-card">
        <form
            action="{{ isset($parking) ? route('console.parkings.update', $parking) : route('console.parkings.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @if (isset($parking))
                @method('PUT')
            @endif

            <div class="form-grid">

                {{-- Nom --}}
                <div class="form-group">
                    <label for="name" class="form-label">Nom du parking <span class="required">*</span></label>
                    <input type="text" id="name" name="name"
                           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           value="{{ old('name', $parking->name ?? '') }}" required>
                    @error('name')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Slug --}}
                <div class="form-group">
                    <label for="slug" class="form-label">Slug <span class="required">*</span></label>
                    <input type="text" id="slug" name="slug"
                           class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}"
                           value="{{ old('slug', $parking->slug ?? '') }}" required>
                    @error('slug')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Ville --}}
                <div class="form-group">
                    <label for="city_slug" class="form-label">Ville <span class="required">*</span></label>
                    <select id="city_slug" name="city_slug"
                            class="form-control {{ $errors->has('city_slug') ? 'is-invalid' : '' }}" required>
                        <option value="">— Sélectionner une ville —</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city['slug'] }}"
                                {{ old('city_slug', $parking->city_slug ?? '') === $city['slug'] ? 'selected' : '' }}>
                                {{ $city['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('city_slug')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Type --}}
                <div class="form-group">
                    <label for="type" class="form-label">Type de parking <span class="required">*</span></label>
                    <select id="type" name="type"
                            class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" required>
                        <option value="surface"   {{ old('type', $parking->type ?? '') === 'surface'   ? 'selected' : '' }}>Surface</option>
                        <option value="sous-sol"  {{ old('type', $parking->type ?? '') === 'sous-sol'  ? 'selected' : '' }}>Sous-sol</option>
                        <option value="autre"     {{ old('type', $parking->type ?? '') === 'autre'     ? 'selected' : '' }}>Autre</option>
                    </select>
                    @error('type')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Capacité --}}
                <div class="form-group">
                    <label for="capacity" class="form-label">Nombre de places <span class="required">*</span></label>
                    <input type="number" id="capacity" name="capacity" min="0"
                           class="form-control {{ $errors->has('capacity') ? 'is-invalid' : '' }}"
                           value="{{ old('capacity', $parking->capacity ?? 0) }}" required>
                    @error('capacity')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Niveaux --}}
                <div class="form-group">
                    <label for="levels" class="form-label">Niveaux</label>
                    <input type="text" id="levels" name="levels"
                           class="form-control {{ $errors->has('levels') ? 'is-invalid' : '' }}"
                           value="{{ old('levels', $parking->levels ?? '') }}"
                           placeholder="ex: 2 niveaux">
                    @error('levels')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Localisation --}}
                <div class="form-group">
                    <label for="location" class="form-label">Localisation</label>
                    <input type="text" id="location" name="location"
                           class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}"
                           value="{{ old('location', $parking->location ?? '') }}"
                           placeholder="ex: Hassan, Rabat">
                    @error('location')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Localisation courte --}}
                <div class="form-group">
                    <label for="short_location" class="form-label">Localisation courte</label>
                    <input type="text" id="short_location" name="short_location"
                           class="form-control {{ $errors->has('short_location') ? 'is-invalid' : '' }}"
                           value="{{ old('short_location', $parking->short_location ?? '') }}"
                           placeholder="ex: Hassan">
                    @error('short_location')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Adresse --}}
                <div class="form-group form-grid-full">
                    <label for="address" class="form-label">Adresse complète</label>
                    <input type="text" id="address" name="address"
                           class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                           value="{{ old('address', $parking->address ?? '') }}">
                    @error('address')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Description --}}
                <div class="form-group form-grid-full">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description"
                              class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                              rows="3">{{ old('description', $parking->description ?? '') }}</textarea>
                    @error('description')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Horaires --}}
                <div class="form-group">
                    <label for="schedule" class="form-label">Horaires</label>
                    <input type="text" id="schedule" name="schedule"
                           class="form-control {{ $errors->has('schedule') ? 'is-invalid' : '' }}"
                           value="{{ old('schedule', $parking->schedule ?? '') }}"
                           placeholder="ex: 24h/24 - 7j/7">
                    @error('schedule')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Tarifs --}}
                <div class="form-group">
                    <label for="rates" class="form-label">Tarifs</label>
                    <input type="text" id="rates" name="rates"
                           class="form-control {{ $errors->has('rates') ? 'is-invalid' : '' }}"
                           value="{{ old('rates', $parking->rates ?? '') }}"
                           placeholder="ex: 5 DH/heure">
                    @error('rates')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Latitude --}}
                <div class="form-group">
                    <label for="lat" class="form-label">Latitude</label>
                    <input type="number" id="lat" name="lat" step="any"
                           class="form-control {{ $errors->has('lat') ? 'is-invalid' : '' }}"
                           value="{{ old('lat', $parking->lat ?? '') }}">
                    @error('lat')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Longitude --}}
                <div class="form-group">
                    <label for="lng" class="form-label">Longitude</label>
                    <input type="number" id="lng" name="lng" step="any"
                           class="form-control {{ $errors->has('lng') ? 'is-invalid' : '' }}"
                           value="{{ old('lng', $parking->lng ?? '') }}">
                    @error('lng')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Lien Google Maps --}}
                <div class="form-group form-grid-full">
                    <label for="maps_url" class="form-label">Lien Google Maps (optionnel)</label>
                    <input type="url" id="maps_url" name="maps_url"
                           class="form-control {{ $errors->has('maps_url') ? 'is-invalid' : '' }}"
                           value="{{ old('maps_url', $parking->maps_url ?? '') }}"
                           placeholder="https://maps.google.com/...">
                    @error('maps_url')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Image --}}
                <div class="form-group form-grid-full">
                    <label for="image" class="form-label">Image du parking</label>
                    @if (isset($parking) && $parking->image)
                        <div style="margin-bottom:10px;">
                            <img src="{{ str_starts_with($parking->image, 'parkings/') ? \Illuminate\Support\Facades\Storage::url($parking->image) : asset($parking->image) }}"
                                 alt="{{ $parking->name }}"
                                 style="height:80px;border-radius:8px;object-fit:cover;">
                            <p style="font-size:0.78rem;color:var(--text-muted);margin-top:4px;">Image actuelle — téléversez une nouvelle pour la remplacer.</p>
                        </div>
                    @endif
                    <input type="file" id="image" name="image"
                           class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                           accept="image/jpeg,image/png,image/webp">
                    @error('image')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Ordre --}}
                <div class="form-group">
                    <label for="sort_order" class="form-label">Ordre d'affichage</label>
                    <input type="number" id="sort_order" name="sort_order" min="0"
                           class="form-control {{ $errors->has('sort_order') ? 'is-invalid' : '' }}"
                           value="{{ old('sort_order', $parking->sort_order ?? 0) }}">
                    @error('sort_order')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                {{-- Statut actif --}}
                <div class="form-group" style="justify-content:flex-end;">
                    <label class="form-label" style="margin-bottom:10px;">Statut</label>
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" id="is_active" name="is_active" value="1"
                               {{ old('is_active', $parking->is_active ?? true) ? 'checked' : '' }}
                               style="width:18px;height:18px;cursor:pointer;">
                        <span style="font-size:0.9rem;font-weight:600;">Parking actif (visible sur le site)</span>
                    </label>
                </div>

            </div>

            <div style="display:flex;gap:12px;margin-top:28px;padding-top:24px;border-top:1px solid var(--border);">
                <button type="submit" class="btn btn-primary">
                    {{ isset($parking) ? 'Enregistrer les modifications' : 'Créer le parking' }}
                </button>
                <a href="{{ route('console.parkings.index') }}" class="btn btn-outline">Annuler</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from name
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    let slugManuallyEdited = {{ isset($parking) ? 'true' : 'false' }};

    slugInput.addEventListener('input', () => { slugManuallyEdited = true; });

    nameInput.addEventListener('input', () => {
        if (slugManuallyEdited) return;
        slugInput.value = nameInput.value
            .toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-');
    });
</script>
@endpush
