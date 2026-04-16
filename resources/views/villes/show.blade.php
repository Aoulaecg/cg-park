@extends('layouts.site')

@section('page_title', $city['name'] . ' | ' . __('metiers.page_title'))
@section('meta_description', __('metiers.city_meta', ['city' => $city['name']]))
@section('body_class', trim((app()->getLocale() === 'ar' ? 'is-rtl ' : '') . 'metiers-page city-page'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/metiers.css') }}">
@endpush

@section('content')
    <section class="city-hero">
        <div class="city-hero-media">
            <img src="{{ asset($city['hero_image']) }}" alt="{{ $city['name'] }}">
            <div class="city-hero-overlay"></div>
        </div>

        <div class="container city-hero-inner" data-reveal>
            <nav class="breadcrumb" aria-label="{{ __('metiers.breadcrumb') }}">
                <a href="{{ route('home') }}">{{ __('home.page_title') }}</a>
                <span>/</span>
                <a href="{{ route('metiers.index') }}">{{ __('home.nos_metiers') }}</a>
                <span>/</span>
                <span>{{ $city['name'] }}</span>
            </nav>
            <p class="metiers-hero-eyebrow">{{ __('metiers.city_label') }}</p>
            <h1 class="metiers-hero-title">{{ $city['name'] }}</h1>
            <p class="metiers-hero-text">{{ __('metiers.city_intro', ['city' => $city['name']]) }}</p>
        </div>
    </section>

    <section class="parking-list-section">
        <div class="container">
            <div class="section-heading" data-reveal>
                <p class="section-label">{{ __('metiers.parking_label') }}</p>
                <h2 class="section-title">{{ __('metiers.city_section_title', ['city' => $city['name']]) }}</h2>
                <p class="section-text">
                    {{ trans_choice('metiers.city_parking_intro', $parkings->count(), ['count' => $parkings->count(), 'city' => $city['name']]) }}
                </p>
            </div>

            <div class="parking-grid">
                @foreach ($parkings as $parking)
                    <article class="parking-card" data-reveal>
                        <a href="{{ route('parkings.show', $parking['slug']) }}" class="parking-card-link">
                            <div class="parking-card-media">
                                <img src="{{ asset($parking['image']) }}" alt="{{ $parking['name'] }}">
                                <div class="parking-card-overlay"></div>
                            </div>

                            <div class="parking-card-body">
                                <span class="parking-card-badge">{{ __('metiers.type_' . $parking['type']) }}</span>
                                <h3 class="parking-card-title">{{ $parking['name'] }}</h3>
                                <p class="parking-card-meta">{{ $parking['capacity'] }} {{ __('metiers.places') }} | {{ $parking['short_location'] }}</p>
                                <p class="parking-card-description">{{ $parking['description'] }}</p>
                                <span class="parking-card-cta">{{ __('metiers.view_details') }}</span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="page-back-link">
                <a href="{{ route('metiers.index') }}">{{ __('metiers.back_to_cities') }}</a>
            </div>
        </div>
    </section>
@endsection
