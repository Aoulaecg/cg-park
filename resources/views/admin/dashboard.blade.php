@extends('admin.layouts.admin')
@section('page_title', 'Dashboard')
@section('content')

<div class="page-header">
    <div>
        <h1>Tableau de bord</h1>
        <p>Bienvenue dans la console CGPark</p>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(63,70,242,0.1); color: #3F46F2;">
            <span style="font-weight:800; font-size:1.2rem;">P</span>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ $stats['parkings_total'] }}</div>
            <div class="stat-label">Parkings total</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(22,163,74,0.1); color: #16a34a;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ $stats['parkings_actifs'] }}</div>
            <div class="stat-label">Parkings actifs</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(245,158,11,0.1); color: #d97706;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ $stats['appels_total'] }}</div>
            <div class="stat-label">Appels d'offres</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(239,68,68,0.1); color: #ef4444;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ $stats['appels_ouverts'] }}</div>
            <div class="stat-label">Appels ouverts</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(99,102,241,0.1); color: #6366f1;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ number_format($stats['total_places']) }}</div>
            <div class="stat-label">Places gérées</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(20,184,166,0.1); color: #0d9488;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ $stats['villes_actives'] }}</div>
            <div class="stat-label">Villes actives</div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 24px;">

    {{-- Derniers parkings --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>Derniers parkings</h2>
            <a href="{{ route('console.parkings.index') }}" class="btn btn-outline btn-sm">Voir tout →</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Ville</th>
                    <th>Type</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentParkings as $parking)
                <tr>
                    <td style="font-weight: 700; color: #1e2a4a;">{{ $parking->name }}</td>
                    <td>{{ $parking->city_slug }}</td>
                    <td><span class="badge badge-gray">{{ $parking->type }}</span></td>
                    <td>
                        @if ($parking->is_active)
                            <span class="badge badge-success">Actif</span>
                        @else
                            <span class="badge badge-gray">Inactif</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                            <h3>Aucun parking</h3>
                            <p>Commencez par ajouter un parking.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="admin-card-footer">
            <a href="{{ route('console.parkings.create') }}">Ajouter un parking</a>
        </div>
    </div>

    {{-- Derniers appels d'offres --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>Derniers appels d'offres</h2>
            <a href="{{ route('console.appels-offres.index') }}" class="btn btn-outline btn-sm">Voir tout →</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Date limite</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentAppels as $appel)
                <tr>
                    <td style="font-weight: 700;">{{ $appel->numero ?? '—' }}</td>
                    <td>{{ $appel->date_limite_formatted ?? '—' }}</td>
                    <td>
                        @if ($appel->statut === 'ouvert')
                            <span class="badge badge-success">Ouvert</span>
                        @elseif ($appel->statut === 'ferme')
                            <span class="badge badge-warning">Fermé</span>
                        @else
                            <span class="badge badge-gray">Archivé</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">
                        <div class="empty-state">
                            <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <h3>Aucun appel d'offres</h3>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="admin-card-footer">
            <a href="{{ route('console.appels-offres.create') }}">Ajouter</a>
        </div>
    </div>

</div>

{{-- Quick actions --}}
<div style="margin-top: 28px;">
    <h2 style="font-size: 1rem; font-weight: 700; color: #1e2a4a; margin-bottom: 14px;">Actions rapides</h2>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">

        <a href="{{ route('console.parkings.create') }}"
           style="background: #fff; border: 1px solid #e8edf3; border-left: 3px solid var(--accent); border-radius: 10px; padding: 20px; display: flex; gap: 14px; align-items: center; text-decoration: none; transition: box-shadow 0.2s, transform 0.2s;"
           onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)';"
           onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)';">
            <div style="width: 44px; height: 44px; background: rgba(63,70,242,0.1); color: #3F46F2; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.2rem; flex-shrink: 0;">P</div>
            <div>
                <div style="font-weight: 700; color: #1e2a4a; font-size: 0.95rem;">Nouveau parking</div>
                <div style="font-size: 0.8rem; color: #94a3b8; margin-top: 2px;">Ajouter un parking à la base de données</div>
            </div>
        </a>

        <a href="{{ route('console.appels-offres.create') }}"
           style="background: #fff; border: 1px solid #e8edf3; border-left: 3px solid #d97706; border-radius: 10px; padding: 20px; display: flex; gap: 14px; align-items: center; text-decoration: none; transition: box-shadow 0.2s, transform 0.2s;"
           onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)';"
           onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)';">
            <div style="width: 44px; height: 44px; background: rgba(245,158,11,0.1); color: #d97706; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div>
                <div style="font-weight: 700; color: #1e2a4a; font-size: 0.95rem;">Nouvel appel d'offres</div>
                <div style="font-size: 0.8rem; color: #94a3b8; margin-top: 2px;">Publier un appel d'offres</div>
            </div>
        </a>

    </div>
</div>

@endsection
