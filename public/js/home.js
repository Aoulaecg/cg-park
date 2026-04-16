document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('[data-slider]');
    const track = slider?.querySelector('[data-slider-track]');
    const slides = track ? Array.from(track.querySelectorAll('[data-slide]')) : [];
    const prevButton = slider?.querySelector('[data-slider-prev]');
    const nextButton = slider?.querySelector('[data-slider-next]');
    const dots = slider ? Array.from(slider.querySelectorAll('[data-slider-dot]')) : [];
    const menuToggle = document.querySelector('[data-menu-toggle]');
    const navigation = document.querySelector('[data-navigation]');
    const revealItems = Array.from(document.querySelectorAll('[data-reveal]'));
    const partnerCarousels = Array.from(document.querySelectorAll('[data-partner-carousel]'));
    const languageSwitchers = Array.from(document.querySelectorAll('[data-language-switcher]'));

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

    if ('IntersectionObserver' in window && revealItems.length > 0) {
        const observer = new IntersectionObserver((entries, instance) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('is-visible');
                instance.unobserve(entry.target);
            });
        }, {
            threshold: 0.18,
            rootMargin: '0px 0px -60px 0px',
        });

        revealItems.forEach((item) => observer.observe(item));
    } else {
        revealItems.forEach((item) => item.classList.add('is-visible'));
    }

    partnerCarousels.forEach((carousel) => {
        const track = carousel.querySelector('[data-partner-track]');
        const itemCount = Number(track?.style.getPropertyValue('--partner-count')) || track?.querySelectorAll('.partner-card').length || 6;
        const duration = Math.max(itemCount * 4.5, 24);

        track?.style.setProperty('--partner-duration', `${duration}s`);

        carousel.addEventListener('mouseenter', () => {
            carousel.classList.add('is-paused');
        });

        carousel.addEventListener('mouseleave', () => {
            carousel.classList.remove('is-paused');
        });

        carousel.addEventListener('focusin', () => {
            carousel.classList.add('is-paused');
        });

        carousel.addEventListener('focusout', () => {
            carousel.classList.remove('is-paused');
        });
    });

    languageSwitchers.forEach((switcher) => {
        const trigger = switcher.querySelector('[data-language-trigger]');
        const menu = switcher.querySelector('[data-language-menu]');

        const closeSwitcher = () => {
            switcher.classList.remove('is-open');
            trigger?.setAttribute('aria-expanded', 'false');
        };

        trigger?.addEventListener('click', () => {
            const isOpen = switcher.classList.toggle('is-open');
            trigger.setAttribute('aria-expanded', String(isOpen));
        });

        document.addEventListener('click', (event) => {
            if (!switcher.contains(event.target)) {
                closeSwitcher();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeSwitcher();
                trigger?.focus();
            }
        });

        menu?.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                closeSwitcher();
            });
        });
    });
    // Animation compteur au scroll (PRO)
    const counters = document.querySelectorAll('.stat-value');

    let hasAnimated = false;

    if ('IntersectionObserver' in window && counters.length > 0) {
        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting || hasAnimated) return;

                hasAnimated = true;

                counters.forEach(counter => {
                    const target = +counter.getAttribute('data-target');

                    const updateCount = () => {
                        const current = +counter.innerText;
                        let increment;

                        if (target < 100) {
                            increment = 0.2; // 🔥 lent pour 10, 20
                        } else if (target < 1000) {
                            increment = target / 150;
                        } else {
                            increment = target / 100; // normal pour 15000
                        }

                        if (current < target) {
                            counter.innerText = Math.ceil(current + increment);
                            setTimeout(updateCount, 20);
                        } else {
                            counter.innerText = target.toLocaleString();
                        }
                    };

                    updateCount();
                });

                observer.disconnect(); 
            });
        }, {
            threshold: 0.4 
        });

        counterObserver.observe(document.querySelector('.home-stats'));
    }
});
