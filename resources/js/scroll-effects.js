/**
 * Scroll effects shared by every page (moved here from the two layouts, which each had a copy).
 *
 * [data-animate]: fades the element in when it scrolls into view; data-delay="120" staggers it (ms).
 * [data-counter]: counts up to the number, e.g. data-counter="1000" data-suffix="+" data-format="thousands".
 *
 * Both do nothing when the visitor prefers reduced motion; the CSS then shows everything straight away.
 * Imported at the top of app.js so they still run if something later in that file fails.
 */
if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }
            const el = entry.target;
            const delay = parseFloat(el.dataset.delay || '0');
            el.style.setProperty('--animate-delay', delay + 'ms');
            el.classList.add('animate-in');
            revealObserver.unobserve(el);
            setTimeout(() => {
                el.removeAttribute('data-animate');
                el.style.removeProperty('--animate-delay');
            }, delay + 650);
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('[data-animate]').forEach((el) => revealObserver.observe(el));

    const easeOutQuart = (t) => 1 - Math.pow(1 - t, 4);

    const animateCounter = (el) => {
        const target = parseInt(el.dataset.counter, 10);
        const suffix = el.dataset.suffix || '';
        const thousands = el.dataset.format === 'thousands';
        const duration = 1800;
        let start = null;

        const step = (timestamp) => {
            if (!start) {
                start = timestamp;
            }
            const progress = Math.min((timestamp - start) / duration, 1);
            const value = Math.floor(easeOutQuart(progress) * target);
            el.textContent = (thousands ? value.toLocaleString() : value) + suffix;
            if (progress < 1) {
                requestAnimationFrame(step);
            }
        };

        requestAnimationFrame(step);
    };

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }
            animateCounter(entry.target);
            counterObserver.unobserve(entry.target);
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('[data-counter]').forEach((el) => counterObserver.observe(el));
}
