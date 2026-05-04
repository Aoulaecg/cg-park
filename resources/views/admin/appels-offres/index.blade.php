@extends('admin.layouts.admin')
@section('page_title', "Appels d'offres")
@section('content')

<div class="page-header">
    <div>
        <h1>Appels d'offres</h1>
        <p>{{ $appels->total() }} appel(s) au total</p>
    </div>
    <a href="{{ route('console.appels-offres.create') }}" class="btn btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="margin-right: 6px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        Ajouter
    </a>
</div>

<form method="GET" action="{{ route('console.appels-offres.index') }}" class="filter-bar">
    <div class="search-wrap">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
        <input type="text"
               name="search"
               class="form-control search-input"
               placeholder="Rechercher..."
               value="{{ old('search', request('search')) }}">
    </div>

    <select name="statut" class="form-control" style="max-width: 180px;">
        <option value="">Tous les statuts</option>
        <option value="ouvert"  {{ request('statut') === 'ouvert'  ? 'selected' : '' }}>Ouvert</option>
        <option value="ferme"   {{ request('statut') === 'ferme'   ? 'selected' : '' }}>Fermé</option>
        <option value="archive" {{ request('statut') === 'archive' ? 'selected' : '' }}>Archivé</option>
    </select>

    <button type="submit" class="btn btn-outline">Filtrer</button>

    @if (request('search') || request('statut'))
        <a href="{{ route('console.appels-offres.index') }}" class="btn btn-outline">Réinitialiser</a>
    @endif
</form>

<div class="admin-card" style="padding: 0;">
    <table class="admin-table">
        <thead>
            <tr>
                <th>N°</th>
                <th>Titre &amp; Objet</th>
                <th>Date pub.</th>
                <th>Date limite</th>
                <th>Statut</th>
                <th>Fichier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($appels as $appel)
            <tr>
                <td>
                    @if ($appel->numero)
                        <span class="badge badge-blue">{{ $appel->numero }}</span>
                    @else
                        —
                    @endif
                </td>
                <td style="max-width: 320px;">
                    <div style="font-weight: 700; color: #1e2a4a;">{{ $appel->titre }}</div>
                    <div style="font-size: 0.75rem; color: #94a3b8;">{{ \Illuminate\Support\Str::limit($appel->objet, 90) }}</div>
                </td>
                <td>{{ $appel->date_publication_formatted ?? '—' }}</td>
                <td>
                    @if ($appel->statut === 'ouvert' && $appel->date_limite && \Carbon\Carbon::parse($appel->date_limite)->isPast())
                        <span class="badge badge-danger">Expiré</span>
                    @else
                        {{ $appel->date_limite_formatted ?? '—' }}
                    @endif
                </td>
                <td>
                    @if ($appel->statut === 'ouvert')
                        <span class="badge badge-success" style="display: inline-flex; align-items: center; gap: 5px;">
                            <span style="display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: #16a34a;"></span>
                            Ouvert
                        </span>
                    @elseif ($appel->statut === 'ferme')
                        <span class="badge badge-warning" style="display: inline-flex; align-items: center; gap: 5px;">
                            <span style="display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: #d97706;"></span>
                            Fermé
                        </span>
                    @else
                        <span class="badge badge-gray" style="display: inline-flex; align-items: center; gap: 5px;">
                            <span style="display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: #94a3b8;"></span>
                            Archivé
                        </span>
                    @endif
                </td>
                <td>
                    @if ($appel->fichier_path)
                        @php
                            $extension = strtolower(pathinfo($appel->fichier_path, PATHINFO_EXTENSION));
                            $iconColor = match($extension) {
                                'pdf' => '#ef4444',
                                'zip', 'rar' => '#8b5cf6',
                                'doc', 'docx' => '#3b82f6',
                                default => '#64748b'
                            };
                        @endphp
                        <a href="{{ route('console.appels-offres.download', $appel) }}"
                           style="display: inline-flex; align-items: center; gap: 5px; color: {{ $iconColor }}; font-size: 0.82rem; text-decoration: none; font-weight: 600;">
                            @if ($extension === 'zip' || $extension === 'rar')
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11v6m-3-3h6"/>
                                </svg>
                            @else
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            @endif
                            <span style="text-transform: uppercase;">{{ $extension }}</span>
                            {{ \Illuminate\Support\Str::limit($appel->fichier_nom, 15) }}
                        </a>
                    @else
                        <span style="color: #94a3b8;">—</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('console.appels-offres.edit', $appel) }}" class="btn btn-outline btn-sm">Modifier</a>
                        <form method="POST" action="{{ route('console.appels-offres.destroy', $appel) }}" onsubmit="return confirm('Supprimer cet appel d\'offres ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">
                    <div class="empty-state">
                        <svg width="44" height="44" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <h3>Aucun appel d'offres trouvé</h3>
                        <p>Modifiez vos filtres ou ajoutez un nouvel appel d'offres.</p>
                        <a href="{{ route('console.appels-offres.create') }}" class="btn btn-primary">Ajouter</a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if ($appels->hasPages())
    <div class="pagination">
        {{ $appels->links() }}
    </div>
    @endif

    @if ($appels->total() > 0)
    <div style="font-size: 0.8rem; color: #94a3b8; padding: 12px 22px; border-top: 1px solid #f1f5f9;">
        Affichage de {{ $appels->firstItem() }} à {{ $appels->lastItem() }} sur {{ $appels->total() }} résultats
    </div>
    @endif
</div>

@endsection
