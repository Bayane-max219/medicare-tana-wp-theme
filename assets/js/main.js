/**
 * Medicare Tana - main.js
 * Burger menu, smooth scroll, AJAX contact, back-to-top, header scroll
 */

(function () {
    'use strict';

    /* ------------------------------------------------------------------
       1. HEADER : effet scroll
       ------------------------------------------------------------------ */
    const header = document.getElementById('site-header');

    function onScroll() {
        if (window.scrollY > 40) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        toggleBackToTop();
        highlightNavLink();
    }

    window.addEventListener('scroll', onScroll, { passive: true });

    /* ------------------------------------------------------------------
       2. BURGER MENU (mobile)
       ------------------------------------------------------------------ */
    const burger  = document.getElementById('burger-menu');
    const nav     = document.getElementById('site-nav');
    const overlay = document.getElementById('nav-overlay');

    function closeMenu() {
        burger.classList.remove('active');
        nav.classList.remove('open');
        overlay.classList.remove('active');
        burger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    if (burger) {
        burger.addEventListener('click', function () {
            const isOpen = nav.classList.toggle('open');
            burger.classList.toggle('active', isOpen);
            overlay.classList.toggle('active', isOpen);
            burger.setAttribute('aria-expanded', String(isOpen));
            document.body.style.overflow = isOpen ? 'hidden' : '';
        });
    }

    if (overlay) {
        overlay.addEventListener('click', closeMenu);
    }

    // Fermer le menu au clic sur un lien
    document.querySelectorAll('.nav-list a').forEach(function (link) {
        link.addEventListener('click', closeMenu);
    });

    /* ------------------------------------------------------------------
       3. SMOOTH SCROLL (ancres)
       ------------------------------------------------------------------ */
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const target = document.querySelector(targetId);
            if (!target) return;

            e.preventDefault();
            const headerH = header ? header.offsetHeight : 72;
            const top = target.getBoundingClientRect().top + window.scrollY - headerH - 8;

            window.scrollTo({ top: top, behavior: 'smooth' });
        });
    });

    /* ------------------------------------------------------------------
       4. ACTIVE NAV LINK (highlight selon section visible)
       ------------------------------------------------------------------ */
    const sections = document.querySelectorAll('section[id]');

    function highlightNavLink() {
        const scrollPos = window.scrollY + (header ? header.offsetHeight : 72) + 32;

        sections.forEach(function (section) {
            const top    = section.offsetTop;
            const bottom = top + section.offsetHeight;
            const id     = section.getAttribute('id');
            const link   = document.querySelector('.nav-list a[href="#' + id + '"]');

            if (link) {
                if (scrollPos >= top && scrollPos < bottom) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            }
        });
    }

    /* ------------------------------------------------------------------
       5. BACK TO TOP
       ------------------------------------------------------------------ */
    const backToTop = document.getElementById('back-to-top');

    function toggleBackToTop() {
        if (!backToTop) return;
        if (window.scrollY > 400) {
            backToTop.classList.add('visible');
        } else {
            backToTop.classList.remove('visible');
        }
    }

    if (backToTop) {
        backToTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* ------------------------------------------------------------------
       6. AJAX CONTACT FORM
       ------------------------------------------------------------------ */
    const form      = document.getElementById('medicare-contact-form');
    const alertBox  = document.getElementById('form-alert');
    const submitBtn = document.getElementById('form-submit');

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Validation basique
            const name    = form.querySelector('[name="name"]').value.trim();
            const email   = form.querySelector('[name="email"]').value.trim();
            const message = form.querySelector('[name="message"]').value.trim();

            if (!name || !email || !message) {
                showAlert('Veuillez remplir tous les champs obligatoires.', 'error');
                return;
            }

            if (!isValidEmail(email)) {
                showAlert('Adresse email invalide.', 'error');
                return;
            }

            // État loading
            setSubmitLoading(true);
            hideAlert();

            const data = new FormData(form);
            data.append('action', 'medicare_contact');

            fetch(medicareAjax.ajaxurl, {
                method: 'POST',
                body: data,
            })
                .then(function (res) { return res.json(); })
                .then(function (res) {
                    if (res.success) {
                        showAlert(res.data.message || 'Message envoyé avec succès !', 'success');
                        form.reset();
                    } else {
                        showAlert(res.data.message || 'Une erreur est survenue.', 'error');
                    }
                })
                .catch(function () {
                    showAlert('Erreur réseau. Veuillez réessayer.', 'error');
                })
                .finally(function () {
                    setSubmitLoading(false);
                });
        });
    }

    function showAlert(message, type) {
        if (!alertBox) return;
        alertBox.textContent = message;
        alertBox.className = 'form-alert ' + type;
    }

    function hideAlert() {
        if (!alertBox) return;
        alertBox.className = 'form-alert';
        alertBox.textContent = '';
    }

    function setSubmitLoading(loading) {
        if (!submitBtn) return;
        const icon = submitBtn.querySelector('i');
        const text = submitBtn.querySelector('span');

        submitBtn.disabled = loading;

        if (loading) {
            if (icon) icon.className = 'fas fa-spinner fa-spin';
            if (text) text.textContent = 'Envoi en cours…';
        } else {
            if (icon) icon.className = 'fas fa-paper-plane';
            if (text) text.textContent = 'Envoyer le message';
        }
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    /* ------------------------------------------------------------------
       7. ANIMATION D'ENTRÉE (Intersection Observer)
       ------------------------------------------------------------------ */
    if ('IntersectionObserver' in window) {
        const style = document.createElement('style');
        style.textContent = [
            '.anim-fade { opacity: 0; transform: translateY(24px); transition: opacity .6s ease, transform .6s ease; }',
            '.anim-fade.visible { opacity: 1; transform: translateY(0); }',
        ].join('');
        document.head.appendChild(style);

        const animTargets = document.querySelectorAll(
            '.service-card, .doctor-card, .contact-info-item, .why-us-list li, .about-number'
        );

        animTargets.forEach(function (el, i) {
            el.classList.add('anim-fade');
            el.style.transitionDelay = (i % 3) * 0.1 + 's';
        });

        const observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.15 }
        );

        animTargets.forEach(function (el) { observer.observe(el); });
    }

})();
