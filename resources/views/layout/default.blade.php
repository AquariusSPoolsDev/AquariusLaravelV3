{{-- DEFAULT TEMPLATE USED ON ALL PAGES --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <x-partials.head-metadata />
</head>

<body class="antialiased scroll-mt-22 lg:scroll-mt-25">
    {{-- NAVBAR --}}
    <x-partials.navbar-menu-top />

    {{-- MAIN CONTENT PAGE --}}
    <main class="mt-22 lg:mt-25 text-sm lg:text-base">
        {{-- PAGE HEADER TITLE --}}
        <x-reusables.page-header :headerTitle="$headerTitle" :headerSubtitle="$headerSubtitle" :imageFileLoc="$imageFileLoc" />

        {{-- MAIN CONTAINER --}}
        <article class="main-container">
            @yield('content')
        </article>
    </main>

    {{-- FULL-WIDTH CTA BANNER (opt-in per page via @section('cta')) --}}
    @yield('cta')

    <x-partials.footer-bottom />
    <x-partials-br.back-to-top-btn />
    <x-partials-br.chat-btn-wa />

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
    </script>
</body>

</html>