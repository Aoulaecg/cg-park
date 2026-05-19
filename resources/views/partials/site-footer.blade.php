@php
    $footerLogo = asset('assets/LogoPieds.png');

    $footerPartners = [
        ['label' => 'Partenaire 1','path' => asset('assets/Excellence1.png'),'fallback' => 'P1'],
        [ 'label' => 'Partenaire 2','path' => asset('assets/City.jpeg'),'fallback' => 'P2'],
        [ 'label' => 'Partenaire 3','path' => asset('assets/Respo.jpeg'),'fallback' => 'P3'],
    ];
@endphp

<footer class="site-footer" aria-label="{{ __('home.footer_label') }}">
    <div class="container footer-main">
        <div class="footer-column footer-brand-column">
            <a href="{{ route('home') }}" class="footer-brand" aria-label="Accueil CG Park">
                <img src="{{ $footerLogo }}" alt="Logo CG Park" class="footer-brand-logo">
            </a>

            <p class="footer-description">{{ __('home.footer_description') }}</p>

            <div class="footer-partners" aria-label="{{ __('home.footer_partners') }}">
                @foreach ($footerPartners as $partner)
                    <div class="footer-partner-item">
                        @if ($partner['path'])
                            <img src="{{ $partner['path'] }}" alt="{{ $partner['label'] }}" class="footer-partner-logo">
                        @else
                            <span class="footer-partner-placeholder" aria-label="{{ $partner['label'] }}">{{ $partner['fallback'] }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="footer-column">
            <h3 class="footer-title">{{ __('home.plan_du_site') }}</h3>
            <nav class="footer-nav" aria-label="{{ __('home.plan_du_site') }}">
                <a href="{{ route('gouvernance') }}">{{ __('home.gouvernance') }}</a>
                <a href="{{ route('apropos') }}">{{ __('home.a_propos') }}</a>
                <a href="{{ route('metiers.index') }}">{{ __('home.nos_metiers') }}</a>
                <a href="{{ route('appels-offres.index') }}">{{ __('home.appels_offres_consultation') }}</a>
            </nav>
        </div>

        <div class="footer-column" id="contactez-nous">
            <h3 class="footer-title">{{ __('home.contactez_nous') }}</h3>
            <div class="footer-contact-list">
                <div class="footer-contact-item">
                    <span class="footer-contact-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M6.6 10.8C8.4 14.3 11.1 17 14.6 18.8L17.3 16.1C17.7 15.7 18.3 15.6 18.8 15.7C20.1 16.1 21.5 16.3 23 16.3C23.6 16.3 24 16.7 24 17.3V22C24 22.6 23.6 23 23 23C10.3 23 0 12.7 0 0C0 -0.6 0.4 -1 1 -1H5.7C6.3 -1 6.7 -0.6 6.7 0C6.7 1.5 6.9 2.9 7.3 4.2C7.5 4.7 7.3 5.3 7 5.7L4.3 8.4C4.9 9.2 5.7 10 6.6 10.8Z" transform="translate(0 1) scale(0.95)"></path>
                        </svg>
                    </span>
                    <div class="footer-contact-text">
                        <p>05 37 71 38 15/25</p>
                        <p>05 37 71 38 03</p>
                    </div>
                </div>

                <div class="footer-contact-item">
                    <span class="footer-contact-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M2 5H22V19H2V5Z"></path>
                            <path d="M3 6L12 13L21 6"></path>
                        </svg>
                    </span>
                    <div class="footer-contact-text">
                        <p><a href="mailto:cgp@cdg-cgpark.com">cgp@cdg-cgpark.com</a></p>
                    </div>
                </div>

                <div class="footer-contact-item">
                    <span class="footer-contact-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 22C12 22 5 15.8 5 10C5 6.1 8.1 3 12 3C15.9 3 19 6.1 19 10C19 15.8 12 22 12 22Z"></path>
                            <circle cx="12" cy="10" r="2.6"></circle>
                        </svg>
                    </span>
                    <div class="footer-contact-text">
                        <p>{!! nl2br(__('home.address_line_1')) !!}</p>
                        <p>{!! nl2br(__('home.address_line_2')) !!}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-column">
            <h3 class="footer-title">{{ __('home.nous_suivre') }}</h3>
            <div class="footer-socials">
                <a
                    href="https://www.linkedin.com/company/compagnie-g%C3%A9n%C3%A9rale-des-parkings-cdg/posts/?feedView=all"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="footer-social-card footer-social-linkedin"
                    aria-label="Visiter la page LinkedIn de CGPark"
                >
                    <img
                        src="{{ asset('assets/Linkedin.png') }}"
                        alt="LinkedIn"
                        class="footer-social-card-icon"
                    >
                </a>
            </div>
        </div>
    </div>

    <div class="container footer-bottom">
        <p class="footer-bottom-copy">{{ __('home.footer_copyright') }}</p>
        <a href="{{ asset('documents/Mentions Légales .pdf') }}" class="footer-bottom-link" target="_blank" rel="noopener noreferrer">{{ __('home.view_conditions') }}</a>
    </div>
</footer>
