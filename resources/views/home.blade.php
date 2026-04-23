@extends('layouts.site')

@section('page_title', __('home.page_title'))
@section('meta_description', __('home.page_description'))
@section('body_class', app()->getLocale() === 'ar' ? 'is-rtl' : '')

@section('content')
    @php
        $slides = [
            ['image' => asset('assets/Acc1.jpeg'), 'eyebrow' => __('home.hero_eyebrow'), 'title' => __('home.hero_title_1'), 'text' => __('home.hero_text_1')],
            ['image' => asset('assets/Acc2.png'), 'eyebrow' => __('home.hero_eyebrow'), 'title' => __('home.hero_title_2'), 'text' => __('home.hero_text_2')],
            ['image' => asset('assets/Acc3.png'), 'eyebrow' => __('home.hero_eyebrow'), 'title' => __('home.hero_title_3'), 'text' => __('home.hero_text_3')],
             ['image' => asset('assets/Acc4.png'), 'eyebrow' => __('home.hero_eyebrow'), 'title' => __('home.hero_title_4'), 'text' => __('home.hero_text_4')],
        ];

        $stats = [
            ['value' => '27', 'label' => __('home.stat_parking_sites'), 'icon' => 'parking'],
            ['value' => '11 650', 'label' => __('home.stat_spaces_managed'), 'icon' => 'grid'],
            ['value' => '7', 'label' => __('home.stat_cities'), 'icon' => 'location'],
        ];

        $partners = [
            ['name' => 'Partenaire 2', 'image' => asset('assets/Onda.png')],
            ['name' => 'Partenaire 2', 'image' => asset('assets/AderFes.png')],
            ['name' => 'Partenaire 2', 'image' => asset('assets/Auda.png')],
            ['name' => 'Partenaire 2', 'image' => asset('assets/MSE.png')],
            ['name' => 'Partenaire 2', 'image' => asset('assets/AlManar.png')],
            ['name' => 'Partenaire 2', 'image' => asset('assets/Sapst.png')],
        ];

        $mobileApp = [
            'eyebrow' => __('home.mobile_eyebrow'),
            'title' => __('home.application_mobile'),
            'description' => __('home.mobile_description'),
            'screen' => asset('assets/AppMobile.png'),
            'app_store' => asset('images/app-store-badge.svg'),
            'google_play' => asset('images/google-play-badge.svg'),
        ];
    @endphp

    <section class="hero-slider" aria-label="{{ __('home.hero_label') }}" data-slider>
        <div class="hero-track" data-slider-track>
            @foreach ($slides as $index => $slide)
                <article
                    class="hero-slide {{ $index === 0 ? 'is-active' : '' }}"
                    style="--slide-bg: url('{{ $slide['image'] }}');"
                    aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
                    data-slide
                >
                    <div class="hero-overlay"></div>

                    <div class="container hero-content">
                        <div class="hero-copy">
                            <h1 class="hero-title">{{ $slide['title'] }}</h1>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <button class="slider-control slider-control-prev" type="button" aria-label="{{ __('home.previous_slide') }}" data-slider-prev>
            <span aria-hidden="true">&#10094;</span>
        </button>
        <button class="slider-control slider-control-next" type="button" aria-label="{{ __('home.next_slide') }}" data-slider-next>
            <span aria-hidden="true">&#10095;</span>
        </button>

        <div class="hero-indicators" aria-label="{{ __('home.slider_navigation') }}">
            @foreach ($slides as $index => $slide)
                <button
                    class="hero-indicator {{ $index === 0 ? 'is-active' : '' }}"
                    type="button"
                    aria-label="{{ __('home.go_to_slide', ['number' => $index + 1]) }}"
                    aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"
                    data-slider-dot="{{ $index }}"
                ></button>
            @endforeach
        </div>
    </section>

    <section class="home-stats" aria-label="{{ __('home.stats_label') }}">
        <div class="container">
            <div class="stats-shell">
                @foreach ($stats as $index => $stat)
                    <article class="stat-card" style="--stat-delay: {{ $index * 120 }}ms;">
                        <div class="stat-icon" aria-hidden="true">
                            @if ($stat['icon'] === 'parking')
                                <svg viewBox="0 0 24 24">
                                    <path d="M6 4h6a4 4 0 010 8H6z"></path>
                                    <path d="M6 12v8"></path>
                                </svg>
                            @elseif ($stat['icon'] === 'grid')
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                            @else
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 2C8 2 5 5 5 9c0 5 7 13 7 13s7-8 7-13c0-4-3-7-7-7z"></path>
                                    <circle cx="12" cy="9" r="2.5"></circle>
                                </svg>
                            @endif
                        </div>

                        <div class="stat-copy">
                            <p class="stat-value" data-target="{{ preg_replace('/[^0-9]/', '', $stat['value']) }}">0</p>
                            <p class="stat-label">{{ $stat['label'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="institutional-mobility-section" aria-labelledby="institutional-mobility-title" data-reveal>
        <div class="container">
            <div class="institutional-mobility-shell">
                <div class="institutional-mobility-copy">
                    <p class="institutional-mobility-eyebrow">Mobilit&eacute; &amp; r&eacute;seau international</p>
                    <h2 class="institutional-mobility-title" id="institutional-mobility-title">CGPark &amp; l&rsquo;UITP</h2>
                    <p class="institutional-mobility-lead">
                        CGPark s&rsquo;inscrit dans une vision moderne de la mobilit&eacute; urbaine, o&ugrave; le stationnement constitue un levier essentiel de fluidit&eacute;, d&rsquo;accessibilit&eacute; et de qualit&eacute; de service.
                    </p>
                    <p class="institutional-mobility-text">
                        Compagnie G&eacute;n&eacute;rale des Parkings &eacute;volue dans un &eacute;cosyst&egrave;me consacr&eacute; au stationnement intelligent et aux services facilitant les d&eacute;placements. Cette dynamique fait &eacute;cho aux enjeux port&eacute;s &agrave; l&rsquo;&eacute;chelle internationale par l&rsquo;UITP, organisation de r&eacute;f&eacute;rence du transport public et de la mobilit&eacute; durable.
                    </p>

                    <div class="institutional-mobility-highlights" aria-label="Domaines de r&eacute;f&eacute;rence">
                        <span class="institutional-mobility-highlight">Mobilit&eacute; urbaine</span>
                        <span class="institutional-mobility-highlight">Stationnement intelligent</span>
                    </div>
                </div>

                <aside class="uitp-card" aria-label="Pr&eacute;sentation de l'UITP">
                    <div class="uitp-card-header">
                        <div>
                            <p class="uitp-card-kicker">Association Internationale des Transports Publics</p>
                            <h3 class="uitp-card-title">Union Internationale des Transports Publics</h3>
                        </div>
                    </div>

                    <p class="uitp-card-text">
                        L&rsquo;UITP (Union Internationale des Transports Publics / International Association of Public Transport) est le r&eacute;seau mondial de r&eacute;f&eacute;rence du transport public et de la mobilit&eacute; durable. Cr&eacute;&eacute;e en 1885, elle rassemble environ 2&nbsp;000 organisations membres dans pr&egrave;s de 100 pays et territoires autour de l&rsquo;innovation, de la performance et de la qualit&eacute; des r&eacute;seaux de transport.
                    </p>

                    <a
                        class="uitp-card-link"
                        href="https://www.uitp.org/"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Visiter le site de l&rsquo;UITP
                    </a>
                </aside>
            </div>
        </div>
    </section>

    <section class="partners-section" id="partenaires" aria-label="{{ __('home.nos_partenaires') }}" data-reveal>
        <div class="container">
            <div class="partners-section-heading">
                <p class="partners-section-eyebrow">{{ __('home.partners_eyebrow') }}</p>
                <h2 class="partners-section-title">{{ __('home.nos_partenaires') }}</h2>
                <p class="partners-section-text">{{ __('home.partners_intro') }}</p>
            </div>

            <div class="partners-carousel" data-partner-carousel>
                <div class="partners-carousel-track" data-partner-track style="--partner-count: {{ count($partners) }};">
                    @for ($copy = 0; $copy < 2; $copy++)
                        <div class="partners-carousel-group" aria-hidden="{{ $copy === 1 ? 'true' : 'false' }}">
                            @foreach ($partners as $partner)
                                <article class="partner-card">
                                <div class="partner-card-logo-wrap">
                                    @if ($partner['image'])
                                <img src="{{ $partner['image'] }}" alt="{{ $partner['name'] }}" class="partner-card-logo">
                                    @else
                                <span class="partner-card-text">{{ $partner['name'] }}</span>
                                    @endif
                                </div>
                                </article>
                            @endforeach
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>

    <section class="mobile-app-section" id="application-mobile" aria-label="{{ __('home.application_mobile') }}">
        <div class="container mobile-app-layout">
            <div class="mobile-app-media" data-reveal>
                <img class="mobile-app-image" src="{{ $mobileApp['screen'] }}" alt="{{ __('home.application_mobile') }}">
            </div>

            <div class="mobile-app-content" data-reveal>
                <p class="mobile-app-eyebrow">{{ $mobileApp['eyebrow'] }}</p>
                <h2 class="mobile-app-title">{{ $mobileApp['title'] }}</h2>
                <p class="mobile-app-text">{{ $mobileApp['description'] }}</p>
                <div class="store-badges mobile-app-store-badges">
                    <a href="#" class="store-badge-link" aria-label="{{ __('home.download_app_store') }}">
                        <img src="{{ $mobileApp['app_store'] }}" alt="Download on the App Store">
                    </a>
                    <a href="#" class="store-badge-link" aria-label="{{ __('home.download_google_play') }}">
                        <img src="{{ $mobileApp['google_play'] }}" alt="Get it on Google Play">
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
