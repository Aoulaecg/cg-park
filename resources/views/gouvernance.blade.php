@extends('layouts.site')

@section('page_title', __('gouvernance.page_title'))
@section('meta_description', __('gouvernance.page_description'))
@section('body_class', trim((app()->getLocale() === 'ar' ? 'is-rtl ' : '') . 'governance-page'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/governance.css') }}">
@endpush

@section('content')
    @php
        $boardMembers = [
            'M. Taoufik MARZOUKI ZEROUALI - Président du conseil',
            'CDG Développement représentée par M.Taoufik MARZOUKI ZEROUALI',
            'M. Mohammed Amine EL HAJHOUJ',
            'M. Rashid BELQASMI',
        ];

        $auditCommitteeMembers = [
            'M. Mohammed Amin EL HAJHOUJ - Président',
            'Mᵐᵉ Siham BENCHAOU',
            'M. Rashid BELQASMI',
            
        ];

        $investmentCommitteeMembers = [
            'M. Taoufik MARZOUKI ZEROUALI - Président',
            'Mᵐᵉ Siham BENCHAOU',
            'M. Brahim KHEIREDDINE',
           
        ];

        $nominationCommitteeMembers = [
            'M. Taoufik MARZOUKI ZEROUALI - Président',
            'M. Rashid BELQASMI',
            'M. Brahim KHEIREDDINE',
        ];
    @endphp

    <section class="governance-hero">
        <div class="container governance-hero-inner" data-reveal>
            <p class="governance-hero-eyebrow">{{ __('gouvernance.eyebrow') }}</p>
            <h1 class="governance-hero-title">{{ __('gouvernance.page_heading') }}</h1>
        </div>
    </section>

    <section class="governance-section">
        <div class="container governance-content">
            <article class="governance-card" data-reveal>
                <header class="governance-card-header">
                    <h2 class="governance-card-title">{{ __('gouvernance.director_title') }}</h2>
                    <!-- <span class="governance-card-symbol" aria-hidden="true"></span> -->
                </header>

                <div class="governance-card-body governance-director-body">
                    <!-- <div class="governance-director-aside">
                        <div class="governance-director-panel">
                            <p class="governance-director-role">Directeur G&eacute;n&eacute;ral</p>
                            <h3 class="governance-director-entity">CG Park</h3>
                            <p class="governance-director-support">Vision strat&eacute;gique et pilotage institutionnel</p>
                        </div>
                    </div> -->

                    <div class="governance-director-copy">
                        <p class="governance-director-kicker">Directeur g&eacute;n&eacute;ral</p>
                        <p class="governance-director-name">{{ __('gouvernance.director_name') }}</p>
                        <p class="governance-director-text">
                            Le Maroc connaît aujourd’hui <strong>une dynamique ambitieuse de transformation</strong> et de développement territorial.

Cette vision stratégique place les territoires, les villes et la qualité de vie des citoyens <strong>au cœur des priorités nationales</strong>, avec une attention particulière portée <strong>à la modernisation des infrastructures, à la durabilité et à l’attractivité urbaine.</strong>

Dans ce contexte, <strong>la mobilité urbaine</strong> représente un enjeu majeur de développement et de compétitivité des territoires.

<strong>Le stationnement</strong>, longtemps considéré comme une fonction annexe, constitue désormais <strong>un levier essentiel</strong> d’organisation des flux, d’optimisation de l’espace urbain et d’amélioration de l’expérience des usagers.

Filiale de <strong>CDG Développement</strong>, la branche développement territorial du <strong>Groupe CDG, CG Park</strong> inscrit pleinement son action dans cette dynamique.

Notre ambition est d’accompagner les collectivités, les territoires et les partenaires publics et privés dans la conception, le développement et l’exploitation de solutions de stationnement et de mobilité innovantes, performantes et durables.

Au-delà de <strong>notre métier historique</strong>, nous faisons évoluer notre rôle vers celui d’un <strong>intégrateur de solutions de mobilité</strong>, mobilisant expertise, innovation, digitalisation et intelligence des données afin de contribuer à construire des villes plus fluides, plus connectées, plus attractives et plus humaines.

Parce <strong>qu’au-delà des infrastructures</strong>, notre mission est avant tout de contribuer au <strong>développement</strong> harmonieux des territoires et d’accompagner les <strong>villes de demain.</strong>
                        </p>
                      
                    </div>
                </div>
            </article>

            <section class="governance-bodies-section" data-reveal>
                <div class="governance-section-heading">
                 
                    <h2 class="governance-section-title">Organes de gouvernance</h2>
                    <p class="governance-section-text">
                        Les organes de gouvernance de CG Park accompagnent les grandes orientations strat&eacute;giques, le suivi des engagements et l&rsquo;&eacute;valuation des risques dans un cadre institutionnel clair et structur&eacute;.
                    </p>
                </div>

                <div class="governance-organs-grid">
                    <article class="governance-organ-card collapsed">
                        <header class="governance-organ-header">
                            <h3 class="governance-organ-title">Conseil d&rsquo;Administration</h3>
                            <button class="governance-collapse-btn" aria-label="Toggle content" data-collapse-target="board">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </header>
                        <ul class="governance-organ-list" data-collapse-content="board">
                            @foreach ($boardMembers as $member)
                                <li class="governance-organ-item">
                                    <span class="governance-organ-bullet" aria-hidden="true"></span>
                                    <span class="governance-organ-text">{{ $member }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>

                    <article class="governance-organ-card collapsed">
                        <header class="governance-organ-header">
                            <h3 class="governance-organ-title">Comit&eacute; d&rsquo;Audit et Risques</h3>
                            <button class="governance-collapse-btn" aria-label="Toggle content" data-collapse-target="audit">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </header>
                        <ul class="governance-organ-list" data-collapse-content="audit">
                            @foreach ($auditCommitteeMembers as $member)
                                <li class="governance-organ-item">
                                    <span class="governance-organ-bullet" aria-hidden="true"></span>
                                    <span class="governance-organ-text">{{ $member }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>

                    <article class="governance-organ-card collapsed">
                        <header class="governance-organ-header">
                            <h3 class="governance-organ-title">Comit&eacute; d&rsquo;Investissement et Engagements</h3>
                            <button class="governance-collapse-btn" aria-label="Toggle content" data-collapse-target="investment">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </header>
                        <ul class="governance-organ-list" data-collapse-content="investment">
                            @foreach ($investmentCommitteeMembers as $member)
                                <li class="governance-organ-item">
                                    <span class="governance-organ-bullet" aria-hidden="true"></span>
                                    <span class="governance-organ-text">{{ $member }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>

                    <article class="governance-organ-card collapsed">
                        <header class="governance-organ-header">
                            <h3 class="governance-organ-title">Comit&eacute; de Nomination et R&eacute;mun&eacute;ration</h3>
                            <button class="governance-collapse-btn" aria-label="Toggle content" data-collapse-target="nomination">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </header>
                        <ul class="governance-organ-list" data-collapse-content="nomination">
                            @foreach ($nominationCommitteeMembers as $member)
                                <li class="governance-organ-item">
                                    <span class="governance-organ-bullet" aria-hidden="true"></span>
                                    <span class="governance-organ-text">{{ $member }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>
                </div>
            </section>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const collapseButtons = document.querySelectorAll('.governance-collapse-btn');
        
        // Individual card collapse/expand
        collapseButtons.forEach(button => {
            button.addEventListener('click', function() {
                const card = this.closest('.governance-organ-card');
                const icon = this.querySelector('svg');
                
                if (card.classList.contains('collapsed')) {
                    // Expand - rotate to UP
                    card.classList.remove('collapsed');
                    icon.style.transform = 'rotate(180deg)';
                } else {
                    // Collapse - rotate to DOWN
                    card.classList.add('collapsed');
                    icon.style.transform = 'rotate(0deg)';
                }
            });
        });
    });
</script>
@endpush
