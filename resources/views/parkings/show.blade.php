@extends('layouts.site')

@section('page_title', $parking['name'] . ' | ' . __('metiers.page_title'))
@section('meta_description', __('metiers.parking_meta', ['parking' => $parking['name'], 'city' => $city['name']]))
@section('body_class', trim((app()->getLocale() === 'ar' ? 'is-rtl ' : '') . 'metiers-page parking-page'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/metiers.css') }}">
@endpush

@section('content')
    <section class="parking-hero">
        <div class="parking-hero-media">
            <img src="{{ asset($parking['image']) }}" alt="{{ $parking['name'] }}">
            <div class="parking-hero-overlay"></div>
        </div>

        <div class="container parking-hero-inner" data-reveal>
            <nav class="breadcrumb" aria-label="{{ __('metiers.breadcrumb') }}">
                <a href="{{ route('home') }}">{{ __('home.page_title') }}</a>
                <span>/</span>
                <a href="{{ route('metiers.index') }}">{{ __('home.nos_metiers') }}</a>
                <span>/</span>
                <a href="{{ route('villes.show', $city['slug']) }}">{{ $city['name'] }}</a>
                <span>/</span>
                <span>{{ $parking['name'] }}</span>
            </nav>

            <p class="metiers-hero-eyebrow">{{ __('metiers.parking_label') }}</p>
            <h1 class="metiers-hero-title">{{ $parking['name'] }}</h1>
            <p class="metiers-hero-text">{{ $parking['description'] }}</p>
        </div>
    </section>

    <section class="parking-detail-section">
        <div class="container parking-detail-layout">
            <div class="parking-overview-card" data-reveal>
                <p class="section-label">{{ __('metiers.practical_information') }}</p>
                <h2 class="section-title">{{ __('metiers.overview_title') }}</h2>
                <p class="section-text">{{ __('metiers.overview_intro', ['parking' => $parking['name'], 'city' => $city['name']]) }}</p>

                <div class="parking-facts-grid">
                    <article class="parking-fact-item">
                        <span class="parking-fact-label">{{ __('metiers.city') }}</span>
                        <span class="parking-fact-value">{{ $city['name'] }}</span>
                    </article>
                    <article class="parking-fact-item">
                        <span class="parking-fact-label">{{ __('metiers.capacity') }}</span>
                        <span class="parking-fact-value">{{ $parking['capacity'] }} {{ __('metiers.places') }}</span>
                    </article>
                    <article class="parking-fact-item">
                        <span class="parking-fact-label">{{ __('metiers.parking_type') }}</span>
                        <span class="parking-fact-value">{{ __('metiers.type_' . $parking['type']) }}</span>
                    </article>
                    <article class="parking-fact-item">
                        <span class="parking-fact-label">{{ __('metiers.levels') }}</span>
                        <span class="parking-fact-value">{{ $parking['levels'] }}</span>
                    </article>
                </div>
            </div>

            <aside class="parking-info-panel" data-reveal>
                <p class="section-label">{{ __('metiers.useful_information') }}</p>
                <div class="parking-side-card">
                    <p class="parking-side-label">{{ __('metiers.rates') }}</p>
                    <p class="parking-side-value">{{ $parking['tariffs'] }}</p>
                </div>
                <div class="parking-side-card">
                    <p class="parking-side-label">{{ __('metiers.subscriptions') }}</p>
                    <p class="parking-side-value">{{ $parking['subscriptions'] }}</p>
                </div>
                <div class="parking-side-card">
                    <p class="parking-side-label">{{ __('metiers.location') }}</p>
                    <p class="parking-side-value">{{ $parking['location'] }}</p>
                </div>
            </aside>
        </div>

        <div class="container parking-extra-layout">
            <article class="parking-map-card" data-reveal>
                <p class="section-label">{{ __('metiers.location_map') }}</p>
                <h2 class="section-title">{{ __('metiers.location') }}</h2>
                <div class="parking-map-placeholder">
                    <span>{{ $parking['location'] }}</span>
                </div>
            </article>

            <article class="parking-related-card" data-reveal>
                <p class="section-label">{{ __('metiers.related_parkings') }}</p>
                <h2 class="section-title">{{ __('metiers.related_title', ['city' => $city['name']]) }}</h2>
                <div class="parking-related-list">
                    @forelse ($relatedParkings as $related)
                        <a href="{{ route('parkings.show', $related['slug']) }}" class="parking-related-item">
                            <span class="parking-related-name">{{ $related['name'] }}</span>
                            <span class="parking-related-meta">{{ $related['capacity'] }} {{ __('metiers.places') }}</span>
                        </a>
                    @empty
                        <p class="section-text">{{ __('metiers.no_related') }}</p>
                    @endforelse
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
