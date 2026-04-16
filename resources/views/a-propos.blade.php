@extends('layouts.site')

@section('page_title', __('apropos.page_title'))
@section('meta_description', __('apropos.page_description'))
@section('body_class', trim((app()->getLocale() === 'ar' ? 'is-rtl ' : '') . 'about-page'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')
    @php
        $featureCards = [
            [
                'title' => __('apropos.missions_title'),
                'text' => __('apropos.missions_text'),
                'icon' => 'mission',
            ],
            [
                'title' => __('apropos.activities_title'),
                'text' => __('apropos.activities_text'),
                'icon' => 'activities',
            ],
            [
                'title' => __('apropos.roles_title'),
                'text' => __('apropos.roles_text'),
                'icon' => 'roles',
            ],
        ];

        $serviceItems = [
            __('apropos.service_1'),
            __('apropos.service_2'),
            __('apropos.service_3'),
            __('apropos.service_4'),
        ];
    @endphp

    <section class="about-hero">
        <div class="container about-hero-inner" data-reveal>
            <p class="about-hero-eyebrow">{{ __('apropos.eyebrow') }}</p>
            <h1 class="about-hero-title">{{ __('apropos.page_heading') }}</h1>
            <p class="about-hero-text">{{ __('apropos.intro_text') }}</p>
        </div>
    </section>

    <section class="about-features-section">
        <div class="container">
            <div class="about-features-grid">
                @foreach ($featureCards as $card)
                    <article class="about-feature-card" data-reveal>
                        <div class="about-feature-icon" aria-hidden="true">
                            @if ($card['icon'] === 'mission')
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="9"></circle>
                                    <path d="M12 7V12L15.5 15.5"></path>
                                </svg>
                            @elseif ($card['icon'] === 'activities')
                                <svg viewBox="0 0 24 24">
                                    <path d="M4 16L9 11L12 14L20 6"></path>
                                    <path d="M15 6H20V11"></path>
                                </svg>
                            @else
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 3L20 7.5V16.5L12 21L4 16.5V7.5L12 3Z"></path>
                                    <path d="M9 12L11 14L15 10"></path>
                                </svg>
                            @endif
                        </div>

                        <h2 class="about-feature-title">{{ $card['title'] }}</h2>
                        <p class="about-feature-text">{{ $card['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="about-services-section">
        <div class="container about-services-layout">
            <div class="about-services-content" data-reveal>
                <p class="about-section-label">{{ __('apropos.services_label') }}</p>
                <h2 class="about-section-title">{{ __('apropos.services_title') }}</h2>
                <p class="about-section-text">{{ __('apropos.services_intro') }}</p>

                <ul class="about-services-list">
                    @foreach ($serviceItems as $item)
                        <li class="about-services-item">
                            <span class="about-services-bullet" aria-hidden="true"></span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <aside class="about-philosophy-card" data-reveal>
                <p class="about-philosophy-label">{{ __('apropos.philosophy_label') }}</p>
                <blockquote class="about-philosophy-quote">
                    {{ __('apropos.philosophy_quote') }}
                </blockquote>
                <p class="about-philosophy-text">{{ __('apropos.philosophy_text') }}</p>
            </aside>
        </div>
    </section>
@endsection
