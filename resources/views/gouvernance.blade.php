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
            'Mme. Siham BENCHAOU',
            'M. Rashid BELQASMI',
            
        ];

        $investmentCommitteeMembers = [
            'M. Taoufik MARZOUKI ZEROUALI - Président',
            'Mme. Siham BENCHAOU',
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
                        <p class="governance-director-kicker">Directeur g&eacute;n&eacute;rale</p>
                        <p class="governance-director-name">{{ __('gouvernance.director_name') }}</p>
                        <p class="governance-director-text">
                            ...........
                        </p>
                      
                    </div>
                </div>
            </article>

            <section class="governance-bodies-section" data-reveal>
                <div class="governance-section-heading">
                    <p class="governance-section-eyebrow">Organes de gouvernance</p>
                    <h2 class="governance-section-title">Instances de pilotage</h2>
                    <p class="governance-section-text">
                        Les organes de gouvernance de CG Park accompagnent les grandes orientations strat&eacute;giques, le suivi des engagements et l&rsquo;&eacute;valuation des risques dans un cadre institutionnel clair et structur&eacute;.
                    </p>
                </div>

                <div class="governance-organs-grid">
                    <article class="governance-organ-card">
                        <header class="governance-organ-header">
                            <h3 class="governance-organ-title">Conseil d&rsquo;Administration</h3>
                            <!-- <span class="governance-organ-index" aria-hidden="true"></span> -->
                        </header>
                        <ul class="governance-organ-list">
                            @foreach ($boardMembers as $member)
                                <li class="governance-organ-item">
                                    <span class="governance-organ-bullet" aria-hidden="true"></span>
                                    <span class="governance-organ-text">{{ $member }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>

                    <article class="governance-organ-card">
                        <header class="governance-organ-header">
                            <h3 class="governance-organ-title">Comit&eacute; d&rsquo;Audit et Risques</h3>
                            <!-- <span class="governance-organ-index" aria-hidden="true">02</span> -->
                        </header>
                        <ul class="governance-organ-list">
                            @foreach ($auditCommitteeMembers as $member)
                                <li class="governance-organ-item">
                                    <span class="governance-organ-bullet" aria-hidden="true"></span>
                                    <span class="governance-organ-text">{{ $member }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>

                    <article class="governance-organ-card">
                        <header class="governance-organ-header">
                            <h3 class="governance-organ-title">Comit&eacute; d&rsquo;Investissement et Engagements</h3>
                            <!-- <span class="governance-organ-index" aria-hidden="true">03</span> -->
                        </header>
                        <ul class="governance-organ-list">
                            @foreach ($investmentCommitteeMembers as $member)
                                <li class="governance-organ-item">
                                    <span class="governance-organ-bullet" aria-hidden="true"></span>
                                    <span class="governance-organ-text">{{ $member }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>

                    <article class="governance-organ-card">
                        <header class="governance-organ-header">
                            <h3 class="governance-organ-title">Comit&eacute; de Nomination et R&eacute;mun&eacute;ration</h3>
                            <!-- <span class="governance-organ-index" aria-hidden="true">04</span> -->
                        </header>
                        <ul class="governance-organ-list">
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
