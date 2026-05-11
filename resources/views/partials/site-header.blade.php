@php
    $currentLocale = app()->getLocale();
    $languageOptions = [
        ['code' => 'fr', 'label' => 'FR', 'name' => __('home.lang_fr')],
        ['code' => 'en', 'label' => 'EN', 'name' => __('home.lang_en')],
        ['code' => 'ar', 'label' => 'AR', 'name' => __('home.lang_ar')],
    ];

    $navLinks = [
        ['label' => __('home.gouvernance'), 'href' => route('gouvernance'), 'active' => request()->routeIs('gouvernance')],
        ['label' => __('home.a_propos'), 'href' => route('apropos'), 'active' => request()->routeIs('apropos')],
        ['label' => __('home.nos_metiers'), 'href' => route('metiers.index'), 'active' => request()->routeIs('metiers.*', 'villes.show', 'parkings.show')],
        ['label' => __('home.appels_offres_consultation'), 'href' => route('appels-offres.index'), 'active' => request()->routeIs('appels-offres.*')],
    ];
@endphp

<header class="site-header">
    <div class="container header-inner">
        <a href="{{ route('home') }}" class="brand" aria-label="Accueil CG Park">
            {{-- Replace this image if you have another official CG Park logo. --}}
            <img src="{{ asset('assets/logo.png') }}" alt="Logo CG Park" class="brand-logo">
        </a>

        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-navigation" data-menu-toggle>
            <span></span>
            <span></span>
            <span></span>
            <span class="sr-only">{{ __('home.open_menu') }}</span>
        </button>

        <div class="header-actions">
            <nav class="site-nav" id="site-navigation" aria-label="{{ __('home.main_navigation') }}" data-navigation>
                @foreach ($navLinks as $link)
                    <a href="{{ $link['href'] }}" class="{{ $link['active'] ? 'is-active' : '' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="language-switcher" data-language-switcher>
                <button
                    class="language-switcher-trigger"
                    type="button"
                    aria-expanded="false"
                    aria-haspopup="true"
                    aria-controls="language-menu"
                    data-language-trigger
                >
                    <span class="language-switcher-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9"></circle>
                            <path d="M3 12H21"></path>
                            <path d="M12 3C14.9 5.8 16.5 8.8 16.5 12C16.5 15.2 14.9 18.2 12 21"></path>
                            <path d="M12 3C9.1 5.8 7.5 8.8 7.5 12C7.5 15.2 9.1 18.2 12 21"></path>
                        </svg>
                    </span>
                    <span class="language-switcher-current">{{ strtoupper($currentLocale) }}</span>
                    <span class="language-switcher-caret" aria-hidden="true"></span>
                </button>

                <div class="language-switcher-menu" id="language-menu" role="menu" data-language-menu>


                

@foreach ($languageOptions as $language)

    @if ($language['code'] === 'ar')

        <a
            href="#"
            class="language-switcher-option"
            role="menuitem"
            lang="{{ $language['code'] }}"
            onclick="event.preventDefault(); alert('La version arabe sera bientôt disponible.');"
        >
            <span class="language-switcher-option-code">{{ $language['label'] }}</span>
            <span class="language-switcher-option-name">{{ $language['name'] }}</span>
        </a>

    @else

        <a
            href="{{ route('locale.switch', ['locale' => $language['code']]) }}"
            class="language-switcher-option {{ $currentLocale === $language['code'] ? 'is-active' : '' }}"
            role="menuitem"
            lang="{{ $language['code'] }}"
        >
            <span class="language-switcher-option-code">{{ $language['label'] }}</span>
            <span class="language-switcher-option-name">{{ $language['name'] }}</span>
        </a>

    @endif

@endforeach




                    <!-- @foreach ($languageOptions as $language)
                        <a
                            href="{{ route('locale.switch', ['locale' => $language['code']]) }}"
                            class="language-switcher-option {{ $currentLocale === $language['code'] ? 'is-active' : '' }}"
                            role="menuitem"
                            lang="{{ $language['code'] }}"
                        >
                            <span class="language-switcher-option-code">{{ $language['label'] }}</span>
                            <span class="language-switcher-option-name">{{ $language['name'] }}</span>
                        </a>
                    @endforeach -->





                </div>
            </div>
        </div>
    </div>
</header>
