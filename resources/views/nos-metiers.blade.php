@extends('layouts.site')

@section('page_title', __('metiers.page_title'))
@section('meta_description', __('metiers.page_description'))
@section('body_class', trim((app()->getLocale() === 'ar' ? 'is-rtl ' : '') . 'metiers-page'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/metiers.css') }}">
@endpush

@section('content')
    <section class="metiers-hero">
        <div class="container metiers-hero-inner" data-reveal>
            <p class="metiers-hero-eyebrow">{{ __('metiers.eyebrow') }}</p>
            <h1 class="metiers-hero-title">{{ __('metiers.page_heading') }}</h1>
            <p class="metiers-hero-text">{{ __('metiers.intro_text') }}</p>
        </div>
    </section>

    <section class="cities-section">
        <div class="container">
            <div class="section-heading" data-reveal>
                <p class="section-label">{{ __('metiers.cities_label') }}</p>
                <h2 class="section-title">{{ __('metiers.cities_title') }}</h2>
                <p class="section-text">{{ __('metiers.cities_intro') }}</p>
            </div>

            <div class="cities-grid">
                @foreach ($cities as $city)
                    <article class="city-card" data-reveal>
                        <a href="{{ route('villes.show', $city['slug']) }}" class="city-card-link" aria-label="{{ __('metiers.discover_city', ['city' => $city['name']]) }}">
                            <div class="city-card-media">
                                <img src="{{ asset($city['image']) }}" alt="{{ $city['name'] }}">
                                <div class="city-card-overlay"></div>
                            </div>

                            <div class="city-card-content">
                                <div>
                                    <h3 class="city-card-title">{{ $city['name'] }}</h3>
                                    <p class="city-card-count">
                                        {{ trans_choice('metiers.parking_count', $city['parking_count'], ['count' => $city['parking_count']]) }}
                                    </p>
                                </div>

                                <span class="city-card-arrow" aria-hidden="true">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M9 6L15 12L9 18"></path>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
