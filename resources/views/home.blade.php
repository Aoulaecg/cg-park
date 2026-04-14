<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CG Park | Accueil</title>
    <meta name="description" content="CG Park - Plateforme institutionnelle, moderne et premium.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|manrope:500,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    @php
        // Vous pouvez modifier ici les images, titres et accroches des slides.
        $slides = [
            [
                'image' => asset('images/hero-cg-park-1.svg'),
                'eyebrow' => 'CG Park',
                'title' => 'Un cadre institutionnel moderne, sobre et ambitieux.',
                'text' => 'Une vitrine pensée pour mettre en valeur la gouvernance, l’expertise et les réalisations du groupe.',
            ],
            [
                'image' => asset('images/hero-cg-park-2.svg'),
                'eyebrow' => 'Vision',
                'title' => 'Des espaces conçus pour la performance, l’élégance et l’impact.',
                'text' => 'Une communication visuelle claire qui reflète un positionnement professionnel et premium.',
            ],
            [
                'image' => asset('images/hero-cg-park-3.svg'),
                'eyebrow' => 'Références',
                'title' => 'Une présence forte portée par une identité graphique maîtrisée.',
                'text' => 'Un hero immersif avec de grands visuels, une navigation fluide et un rendu responsive.',
            ],
        ];
    @endphp

    <div class="page-shell">
        <header class="site-header">
            <div class="container header-inner">
                <a href="{{ url('/') }}" class="brand" aria-label="Accueil CG Park">
                    {{-- Remplacez simplement cette image si vous avez un autre logo officiel CG Park. --}}
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo CG Park" class="brand-logo">
                    <span class="brand-text">
                        <span class="brand-name">CG Park</span>
                        <span class="brand-tagline">Aménagement, expertise et vision institutionnelle</span>
                    </span>
                </a>

                <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-navigation" data-menu-toggle>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span class="sr-only">Ouvrir le menu</span>
                </button>

                <nav class="site-nav" id="site-navigation" aria-label="Navigation principale" data-navigation>
                    <a href="#gouvernance">Gouvernance</a>
                    <a href="#apropos">À propos</a>
                    <a href="#metiers">Nos métiers</a>
                    <a href="#appels-offre">Appels d’offre et consultation</a>
                </nav>
            </div>
        </header>

        <main>
            <section class="hero-slider" aria-label="Mise en avant CG Park" data-slider>
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
                                    <p class="hero-eyebrow">{{ $slide['eyebrow'] }}</p>
                                    <h1 class="hero-title">{{ $slide['title'] }}</h1>
                                    <p class="hero-text">{{ $slide['text'] }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <button class="slider-control slider-control-prev" type="button" aria-label="Slide précédent" data-slider-prev>
                    <span aria-hidden="true">&#10094;</span>
                </button>
                <button class="slider-control slider-control-next" type="button" aria-label="Slide suivant" data-slider-next>
                    <span aria-hidden="true">&#10095;</span>
                </button>

                <div class="hero-indicators" aria-label="Navigation des slides">
                    @foreach ($slides as $index => $slide)
                        <button
                            class="hero-indicator {{ $index === 0 ? 'is-active' : '' }}"
                            type="button"
                            aria-label="Afficher le slide {{ $index + 1 }}"
                            aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"
                            data-slider-dot="{{ $index }}"
                        ></button>
                    @endforeach
                </div>
            </section>

            <section class="home-intro" id="apropos">
                <div class="container intro-grid">
                    <div class="intro-card intro-card-accent">
                        <p class="section-label">À propos</p>
                        <h2>Une présentation institutionnelle claire et contemporaine.</h2>
                        <p>
                            Cette page d’accueil est conçue pour valoriser l’image de CG Park avec un langage visuel premium,
                            des contrastes élégants et une mise en page sobre inspirée des grandes plateformes institutionnelles.
                        </p>
                    </div>

                    <div class="intro-card" id="gouvernance">
                        <p class="section-label">Gouvernance</p>
                        <p>
                            Une structure lisible pour présenter la vision, l’organisation et les engagements stratégiques du groupe.
                        </p>
                    </div>

                    <div class="intro-card" id="metiers">
                        <p class="section-label">Nos métiers</p>
                        <p>
                            Un prolongement naturel de la page d’accueil pour orienter l’utilisateur vers les expertises clés.
                        </p>
                    </div>

                    <div class="intro-card" id="appels-offre">
                        <p class="section-label">Consultation</p>
                        <p>
                            Un espace prêt à accueillir les appels d’offre, documents et informations officielles à diffuser.
                        </p>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>
