@extends('admin.layouts.admin')
@section('page_title', 'Parkings')
@section('content')

<div class="page-header">
    <div>
        <h1>Parkings</h1>
        <p>{{ $parkings->total() }} parking(s) au total</p>
    </div>
    <a href="{{ route('console.parkings.create') }}" class="btn btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="margin-right: 6px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        Ajouter un parking
    </a>
</div>

<form method="GET" action="{{ route('console.parkings.index') }}" class="filter-bar">
    <div class="search-wrap">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
        <input type="text"
               name="search"
               class="form-control search-input"
               placeholder="Rechercher un parking..."
               value="{{ old('search', request('search')) }}">
    </div>

    <select name="city" class="form-control" style="max-width: 180px;">
        <option value="">Toutes les villes</option>
        @foreach ($cities as $city)
            <option value="{{ $city['slug'] }}" {{ request('city') === $city['slug'] ? 'selected' : '' }}>
                {{ $city['name'] }}
            </option>
        @endforeach
    </select>

    <select name="status" class="form-control" style="max-width: 160px;">
        <option value="">Tous les statuts</option>
        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Actif</option>
        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactif</option>
    </select>

    <button type="submit" class="btn btn-outline">Filtrer</button>

    @if (request('search') || request('city') || request('status') !== null && request('status') !== '')
        <a href="{{ route('console.parkings.index') }}" class="btn btn-outline">Réinitialiser</a>
    @endif
</form>

<div class="admin-card" style="padding: 0;">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Parking</th>
                <th>Ville</th>
                <th>Type</th>
                <th>Capacité</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($parkings as $parking)
            <tr>
                <td>
                    <div style="font-weight: 700; color: #1e2a4a;">{{ $parking->name }}</div>
                    <div style="font-size: 0.75rem; color: #94a3b8;">{{ $parking->slug }}</div>
                </td>
                <td style="text-transform: capitalize;">{{ $parking->city_slug }}</td>
                <td>
                    @if ($parking->type === 'surface')
                        <span class="badge badge-blue">{{ $parking->type }}</span>
                    @else
                        <span class="badge badge-gray">{{ $parking->type }}</span>
                    @endif
                </td>
                <td>{{ number_format($parking->capacity) }} places</td>
                <td>
                    @if ($parking->is_active)
                        <span class="badge badge-success">Actif</span>
                    @else
                        <span class="badge badge-danger">Inactif</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('console.parkings.edit', $parking) }}" class="btn btn-outline btn-sm">Modifier</a>
                        <form method="POST" action="{{ route('console.parkings.destroy', $parking) }}" onsubmit="return confirm('Supprimer ce parking ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <div class="empty-state">
                        <svg width="44" height="44" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                        <h3>Aucun parking trouvé</h3>
                        <p>Modifiez vos filtres ou ajoutez un nouveau parking.</p>
                        <a href="{{ route('console.parkings.create') }}" class="btn btn-primary">Ajouter un parking</a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if ($parkings->hasPages())
    <div class="pagination">
        {{ $parkings->links() }}
    </div>
    @endif

    @if ($parkings->total() > 0)
    <div style="font-size: 0.8rem; color: #94a3b8; padding: 12px 22px; border-top: 1px solid #f1f5f9;">
        Affichage de {{ $parkings->firstItem() }} à {{ $parkings->lastItem() }} sur {{ $parkings->total() }} résultats
    </div>
    @endif
</div>

@endsection
