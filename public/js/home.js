document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('[data-slider]');
    const track = slider?.querySelector('[data-slider-track]');
    const slides = track ? Array.from(track.querySelectorAll('[data-slide]')) : [];
    const prevButton = slider?.querySelector('[data-slider-prev]');
    const nextButton = slider?.querySelector('[data-slider-next]');
    const dots = slider ? Array.from(slider.querySelectorAll('[data-slider-dot]')) : [];
    const menuToggle = document.querySelector('[data-menu-toggle]');
    const navigation = document.querySelector('[data-navigation]');

    let currentIndex = 0;
    let autoplayId = null;
    const autoplayDelay = 6000;

    const setActiveSlide = (nextIndex) => {
        slides.forEach((slide, index) => {
            const isActive = index === nextIndex;
            slide.classList.toggle('is-active', isActive);
            slide.setAttribute('aria-hidden', isActive ? 'false' : 'true');
        });

        dots.forEach((dot, index) => {
            const isActive = index === nextIndex;
            dot.classList.toggle('is-active', isActive);
            dot.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });

        currentIndex = nextIndex;
    };

    const showNext = () => setActiveSlide((currentIndex + 1) % slides.length);
    const showPrev = () => setActiveSlide((currentIndex - 1 + slides.length) % slides.length);

    const restartAutoplay = () => {
        if (autoplayId) {
            window.clearInterval(autoplayId);
        }

        if (slides.length > 1) {
            autoplayId = window.setInterval(showNext, autoplayDelay);
        }
    };

    if (slides.length > 0) {
        prevButton?.addEventListener('click', () => {
            showPrev();
            restartAutoplay();
        });

        nextButton?.addEventListener('click', () => {
            showNext();
            restartAutoplay();
        });

        dots.forEach((dot) => {
            dot.addEventListener('click', () => {
                const targetIndex = Number(dot.dataset.sliderDot);
                setActiveSlide(targetIndex);
                restartAutoplay();
            });
        });

        slider?.addEventListener('mouseenter', () => {
            if (autoplayId) {
                window.clearInterval(autoplayId);
            }
        });

        slider?.addEventListener('mouseleave', restartAutoplay);

        document.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowLeft') {
                showPrev();
                restartAutoplay();
            }

            if (event.key === 'ArrowRight') {
                showNext();
                restartAutoplay();
            }
        });

        setActiveSlide(0);
        restartAutoplay();
    }

    menuToggle?.addEventListener('click', () => {
        const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';
        menuToggle.setAttribute('aria-expanded', String(!isOpen));
        navigation?.classList.toggle('is-open', !isOpen);
    });

    navigation?.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            menuToggle?.setAttribute('aria-expanded', 'false');
            navigation.classList.remove('is-open');
        });
    });
});
