{{-- HOMEPAGE TEMPLATE. ONLY APPLIES TO HOMEPAGE --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <x-partials.head-metadata />
    </head>
    <body class="antialiased scroll-mt-22 lg:scroll-mt-25">
        <x-partials.navbar-menu-top />
        
        <main class="mt-22 lg:mt-25 text-sm lg:text-base">
            @yield('content')
        </main>

        <x-partials.footer-bottom />
        <x-partials-br.back-to-top-btn />
        <x-partials-br.chat-btn-wa />
        <x-partials.cookie-consent />

        <script>
            (function () {
                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

                const observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (!entry.isIntersecting) return;
                        var el = entry.target;
                        var delay = parseFloat(el.dataset.delay || '0');
                        el.style.setProperty('--animate-delay', delay + 'ms');
                        el.classList.add('animate-in');
                        observer.unobserve(el);
                        setTimeout(function () {
                            el.removeAttribute('data-animate');
                            el.style.removeProperty('--animate-delay');
                        }, delay + 650);
                    });
                }, { threshold: 0.1 });

                document.querySelectorAll('[data-animate]').forEach(function (el) {
                    observer.observe(el);
                });
            })();

            (function () {
                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

                function animateCounter(el) {
                    var target = parseInt(el.dataset.counter, 10);
                    var suffix = el.dataset.suffix || '';
                    var format = el.dataset.format === 'thousands';
                    var duration = 1800;
                    var start = null;

                    function easeOutQuart(t) { return 1 - Math.pow(1 - t, 4); }

                    function step(ts) {
                        if (!start) start = ts;
                        var progress = Math.min((ts - start) / duration, 1);
                        var value = Math.floor(easeOutQuart(progress) * target);
                        el.textContent = (format ? value.toLocaleString() : value) + suffix;
                        if (progress < 1) requestAnimationFrame(step);
                    }

                    requestAnimationFrame(step);
                }

                var counterObserver = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (!entry.isIntersecting) return;
                        animateCounter(entry.target);
                        counterObserver.unobserve(entry.target);
                    });
                }, { threshold: 0.5 });

                document.querySelectorAll('[data-counter]').forEach(function (el) {
                    counterObserver.observe(el);
                });
            })();
        </script>
    </body>
</html>
