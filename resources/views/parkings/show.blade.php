@extends('layouts.site')

@section('page_title', $parking->name . ' | ' . __('metiers.page_title'))
@section('meta_description', __('metiers.parking_meta', ['parking' => $parking->name, 'city' => $city['name']]))
@section('body_class', trim((app()->getLocale() === 'ar' ? 'is-rtl ' : '') . 'metiers-page parking-page'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/metiers.css') }}">
@endpush

@section('content')
    @php
        $isUnderground  = strtolower((string) ($parking->type ?? '')) === 'sous-sol';
        $parkingAddress = $parking->address ?? $parking->location;
        $googleMapsUrl  = "https://www.google.com/maps?q=" . urlencode($parking->name) . "@{$parking->lat},{$parking->lng}&z=18";
    @endphp

    <section class="parking-hero">
        <div class="parking-hero-media">
            <img src="{{ asset($parking->image) }}" alt="{{ $parking->name }}">
            <div class="parking-hero-overlay"></div>
        </div>

        <div class="container parking-hero-inner" data-reveal>
            <!-- <nav class="breadcrumb" aria-label="{{ __('metiers.breadcrumb') }}">
                <a href="{{ route('home') }}">{{ __('home.page_title') }}</a>
                <span>/</span>
                <a href="{{ route('metiers.index') }}">{{ __('home.nos_metiers') }}</a>
                <span>/</span>
                <a href="{{ route('villes.show', $city['slug']) }}">{{ $city['name'] }}</a>
                <span>/</span>
                <span>{{ $parking->name }}</span>
            </nav> -->

            <p class="metiers-hero-eyebrow">{{ __('metiers.parking_label') }}</p>
            <h1 class="metiers-hero-title">{{ $parking->name }}</h1>
            <p class="metiers-hero-text">{{ $parking->description }}</p>
        </div>
    </section>

    <section class="parking-detail-section">
        <div class="container parking-detail-stack">
            <!-- <article class="parking-detail-card parking-overview-card" data-reveal>
                <p class="section-label">{{ __('metiers.parking_label') }}</p>
                <h2 class="section-title">{{ __('metiers.practical_information') }}</h2>
                <p class="section-text">{{ __('metiers.overview_intro', ['parking' => $parking->name, 'city' => $city['name']]) }}</p>

                <div class="parking-facts-grid">
                    <article class="parking-fact-item">
                        <span class="parking-fact-label">{{ __('metiers.city') }}</span>
                        <span class="parking-fact-value">{{ $city['name'] }}</span>
                    </article>
                    <article class="parking-fact-item">
                        <span class="parking-fact-label">{{ __('metiers.capacity') }}</span>
                        <span class="parking-fact-value">{{ $parking->capacity }} {{ __('metiers.places') }}</span>
                    </article>
                    <article class="parking-fact-item">
                        <span class="parking-fact-label">{{ __('metiers.parking_type') }}</span>
                        <span class="parking-fact-value">{{ __('metiers.type_' . $parking->type) }}</span>
                    </article>

                    @if ($isUnderground && $parking->levels)
                        <article class="parking-fact-item">
                            <span class="parking-fact-label">{{ __('metiers.levels') }}</span>
                            <span class="parking-fact-value">{{ $parking->levels }}</span>
                        </article>
                    @endif

                    @if ($parking->schedule)
                        <article class="parking-fact-item">
                            <span class="parking-fact-label">{{ __('metiers.useful_information') }}</span>
                            <span class="parking-fact-value">{{ $parking->schedule }}</span>
                        </article>
                    @endif

                    @if ($parking->rates)
                        <article class="parking-fact-item">
                            <span class="parking-fact-label">{{ __('metiers.rates') }}</span>
                            <span class="parking-fact-value">{{ $parking->rates }}</span>
                        </article>
                    @endif
                </div>
            </article> -->

            <article class="parking-detail-card parking-map-card" data-reveal>
                <p class="section-label">{{ __('metiers.location') }}</p>
                <h2 class="section-title">{{ __('metiers.location_map') }}</h2>
                <p class="section-text">
                    Retrouvez les informations d'accès du parking {{ $parking->name }} et visualisez rapidement sa localisation dans {{ $city['name'] }}.
                </p>

                <div class="parking-map-layout">
                    <!-- <div class="parking-map-copy">
                        <div class="parking-map-info-grid">
                            <article class="parking-map-info-card">
                                <span class="parking-map-info-label">Parking</span>
                                <span class="parking-map-info-value">{{ $parking->name }}</span>
                            </article>
                            <article class="parking-map-info-card">
                                <span class="parking-map-info-label">Adresse</span>
                                <span class="parking-map-info-value">{{ $parkingAddress }}</span>
                            </article>
                            <article class="parking-map-info-card">
                                <span class="parking-map-info-label">{{ __('metiers.city') }}</span>
                                <span class="parking-map-info-value">{{ $city['name'] }}</span>
                            </article>
                        </div>
                    </div> -->

                    <div class="parking-map-visual">
                        @if ($parking->lat && $parking->lng)
                            <iframe
                                src="https://www.google.com/maps?q={{ $parking->lat }},{{ $parking->lng }}&z=18&output=embed"
                                width="100%"
                                height="100%"
                                style="border:0;border-radius:20px;"
                                allowfullscreen=""
                                loading="lazy">
                            </iframe>
                        @else
                            <div class="parking-map-marker">
                                <span class="parking-map-marker-dot"></span>
                                <span class="parking-map-marker-label">{{ $parking->name }}</span>
                            </div>
                        @endif
                    </div>



                    <div class="parking-facts-grid">
                    <article class="parking-fact-item">
                        <span class="parking-fact-label">{{ __('metiers.city') }}</span>
                        <span class="parking-fact-value">{{ $city['name'] }}</span>
                    </article>
                    <article class="parking-fact-item">
                        <span class="parking-fact-label">{{ __('metiers.capacity') }}</span>
                        <span class="parking-fact-value">{{ $parking->capacity }} {{ __('metiers.places') }}</span>
                    </article>
                    <article class="parking-fact-item">
                        <span class="parking-fact-label">{{ __('metiers.parking_type') }}</span>
                        <span class="parking-fact-value">{{ __('metiers.type_' . $parking->type) }}</span>
                    </article>

                    @if ($isUnderground && $parking->levels)
                        <article class="parking-fact-item">
                            <span class="parking-fact-label">{{ __('metiers.levels') }}</span>
                            <span class="parking-fact-value">{{ $parking->levels }}</span>
                        </article>
                    @endif

                    @if ($parking->schedule)
                        <article class="parking-fact-item">
                            <span class="parking-fact-label">{{ __('metiers.useful_information') }}</span>
                            <span class="parking-fact-value">{{ $parking->schedule }}</span>
                        </article>
                    @endif

                    @if ($parking->rates)
                        <article class="parking-fact-item">
                            <span class="parking-fact-label">{{ __('metiers.rates') }}</span>
                            <span class="parking-fact-value">{{ $parking->rates }}</span>
                        </article>
                    @endif
                </div>




                </div>
            </article>
        </div>

        <div class="container">
            <div class="page-back-link">
                <a href="{{ route('villes.show', $city['slug']) }}">{{ __('metiers.back_to_city', ['city' => $city['name']]) }}</a>
            </div>
        </div>
    </section>
@endsection
