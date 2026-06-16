/**
 * Rare Folk Theme — Main JavaScript
 *
 * @package RareFolk
 */

(function () {
    'use strict';

    // =========================================
    // MOBILE MENU
    // =========================================
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const closeMenuBtn = document.getElementById('close-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    function openMobileMenu() {
        if (mobileMenu) {
            mobileMenu.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeMobileMenu() {
        if (mobileMenu) {
            mobileMenu.classList.remove('open');
            document.body.style.overflow = '';
        }
    }

    if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openMobileMenu);
    if (closeMenuBtn) closeMenuBtn.addEventListener('click', closeMobileMenu);

    // Close on overlay click (not drawer)
    if (mobileMenu) {
        mobileMenu.addEventListener('click', function (e) {
            if (e.target === mobileMenu) closeMobileMenu();
        });
    }

    // =========================================
    // SEARCH OVERLAY
    // =========================================
    const searchToggle = document.getElementById('search-toggle');
    const searchOverlay = document.getElementById('search-overlay');
    const searchClose = document.getElementById('search-close');

    if (searchToggle && searchOverlay) {
        searchToggle.addEventListener('click', function () {
            searchOverlay.style.display = 'block';
            const input = searchOverlay.querySelector('input');
            if (input) {
                setTimeout(function () { input.focus(); }, 100);
            }
        });
    }

    if (searchClose && searchOverlay) {
        searchClose.addEventListener('click', function () {
            searchOverlay.style.display = 'none';
        });
    }

    // =========================================
    // NAVBAR SCROLL BEHAVIOR
    // =========================================
    const nav = document.getElementById('main-nav');
    let lastScrollY = 0;

    function handleScroll() {
        const scrollY = window.scrollY;

        // Track scroll position for parallax
        document.documentElement.style.setProperty('--scroll-y', scrollY);

        // Nav background transition
        if (nav) {
            if (scrollY > 60) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        }

        lastScrollY = scrollY;
    }

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll(); // Initial call

    // =========================================
    // PARALLAX EFFECT
    // =========================================
    function updateParallax() {
        const parallaxElements = document.querySelectorAll('.parallax');
        const scrollY = window.scrollY;

        parallaxElements.forEach(function (el) {
            const rect = el.getBoundingClientRect();
            const speed = 0.3;
            const offset = (scrollY - el.offsetTop) * speed;
            el.style.transform = 'translateY(' + offset + 'px) scale(1.1)';
        });
    }

    window.addEventListener('scroll', updateParallax, { passive: true });

    // =========================================
    // INTERSECTION OBSERVER — FADE UP
    // =========================================
    const fadeUpElements = document.querySelectorAll('.fade-up');

    if (fadeUpElements.length > 0 && 'IntersectionObserver' in window) {
        const fadeObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    fadeObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        fadeUpElements.forEach(function (el) {
            fadeObserver.observe(el);
        });
    }

    // =========================================
    // SIZE SELECTOR
    // =========================================
    document.querySelectorAll('.size-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            if (btn.classList.contains('disabled')) return;

            // Deselect others in same group
            const container = btn.closest('.size-grid');
            if (container) {
                container.querySelectorAll('.size-btn').forEach(function (b) {
                    b.classList.remove('selected');
                });
            }

            btn.classList.add('selected');
        });
    });

    // =========================================
    // CATEGORY FILTER (SHOP & JOURNAL)
    // =========================================
    document.querySelectorAll('.filter-tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
            // Update active state
            const parent = tab.closest('.filter-tabs') || tab.parentElement;
            parent.querySelectorAll('.filter-tab').forEach(function (t) {
                t.classList.remove('active');
            });
            tab.classList.add('active');

            const filter = tab.dataset.filter || tab.dataset.category || 'all';

            // Filter product cards
            document.querySelectorAll('.product-card[data-categories]').forEach(function (card) {
                if (filter === 'all') {
                    card.style.display = '';
                } else {
                    const cats = card.dataset.categories || '';
                    card.style.display = cats.includes(filter) ? '' : 'none';
                }
            });

            // Filter journal cards
            document.querySelectorAll('.journal-card[data-category]').forEach(function (card) {
                if (filter === 'all') {
                    card.style.display = '';
                } else {
                    card.style.display = card.dataset.category === filter ? '' : 'none';
                }
            });
        });
    });

    // =========================================
    // LEGAL PAGE — ACTIVE SECTION HIGHLIGHT
    // =========================================
    const legalSections = document.querySelectorAll('.legal-section');
    const legalNavLinks = document.querySelectorAll('.legal-sidebar .sticky-nav a');

    if (legalSections.length > 0 && legalNavLinks.length > 0) {
        const legalObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    const id = entry.target.id;
                    legalNavLinks.forEach(function (link) {
                        if (link.getAttribute('href') === '#' + id) {
                            link.classList.remove('text-muted');
                            link.classList.add('text-onyx');
                        } else {
                            link.classList.remove('text-onyx');
                            link.classList.add('text-muted');
                        }
                    });
                }
            });
        }, {
            threshold: 0.3,
            rootMargin: '-100px 0px -50% 0px'
        });

        legalSections.forEach(function (section) {
            legalObserver.observe(section);
        });
    }

    // =========================================
    // CONTACT FORM — AJAX SUBMISSION
    // =========================================
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(contactForm);
            formData.append('action', 'rarefolk_contact');
            formData.append('nonce', typeof rarefolk_ajax !== 'undefined' ? rarefolk_ajax.nonce : '');

            const response = document.getElementById('contact-response');
            const submitBtn = contactForm.querySelector('.submit-btn');

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span>Sending...</span>';
            }

            fetch(typeof rarefolk_ajax !== 'undefined' ? rarefolk_ajax.ajax_url : '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData,
            })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (response) {
                    response.style.display = 'block';
                    response.textContent = data.data ? data.data.message : 'Message sent successfully.';
                    response.style.color = data.success ? 'var(--color-heritage-gold)' : 'var(--color-error)';
                }
                if (data.success) contactForm.reset();
            })
            .catch(function () {
                if (response) {
                    response.style.display = 'block';
                    response.textContent = 'An error occurred. Please try again.';
                    response.style.color = 'var(--color-error)';
                }
            })
            .finally(function () {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<span>Transmit</span><span class="material-symbols-outlined" style="font-size: 14px;">arrow_forward</span>';
                }
            });
        });
    }

    // =========================================
    // NEWSLETTER FORM — AJAX SUBMISSION
    // =========================================
    const newsletterForm = document.getElementById('newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(newsletterForm);
            formData.append('action', 'rarefolk_newsletter');
            formData.append('nonce', typeof rarefolk_ajax !== 'undefined' ? rarefolk_ajax.nonce : '');

            const submitBtn = newsletterForm.querySelector('button[type="submit"]');
            const originalText = submitBtn ? submitBtn.textContent : 'Subscribe';

            if (submitBtn) {
                submitBtn.textContent = 'Joining...';
                submitBtn.disabled = true;
            }

            fetch(typeof rarefolk_ajax !== 'undefined' ? rarefolk_ajax.ajax_url : '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData,
            })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (submitBtn) {
                    submitBtn.textContent = data.success ? 'Welcome ✓' : 'Try Again';
                    if (data.success) {
                        newsletterForm.reset();
                        setTimeout(function () {
                            submitBtn.textContent = originalText;
                            submitBtn.disabled = false;
                        }, 3000);
                    } else {
                        submitBtn.disabled = false;
                    }
                }
            })
            .catch(function () {
                if (submitBtn) {
                    submitBtn.textContent = 'Error — Try Again';
                    submitBtn.disabled = false;
                }
            });
        });
    }

    // =========================================
    // SMOOTH SCROLL FOR ANCHOR LINKS
    // =========================================
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const targetId = anchor.getAttribute('href');
            if (targetId === '#' || targetId === '') return;

            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // =========================================
    // ESCAPE KEY HANDLER
    // =========================================
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeMobileMenu();
            if (searchOverlay) searchOverlay.style.display = 'none';
        }
    });

})();
