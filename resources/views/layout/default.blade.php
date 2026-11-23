{{-- THE ONE PUBLIC PAGE TEMPLATE. Pages that set $headerTitle (all except the homepage) get the photo header,
     a centred container and an optional full-width CTA banner. The homepage sets none and lays out its own sections.
     Scroll-in and count-up effects live in resources/js/scroll-effects.js. --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="motion-safe:scroll-smooth">

<head>
    <x-partials.head-metadata />
</head>

<body class="antialiased scroll-mt-20 lg:scroll-mt-23.25">
    {{-- Skip link: first stop for keyboard users, hidden until focused --}}
    <a href="#main-content" class="skip-link">{{ __('strings.skip_to_content') }}</a>
    <x-partials.navbar-menu-top />

    <main id="main-content" tabindex="-1" class="mt-20 lg:mt-23.25 focus:outline-none">
        @isset($headerTitle)
            <x-reusables.page-header :headerTitle="$headerTitle" :headerSubtitle="$headerSubtitle" :imageFileLoc="$imageFileLoc" />

            <div class="main-container">
                @yield('content')
            </div>

            {{-- FULL-WIDTH CTA BANNER (opt-in per page via @section('cta')), inside <main> so it sits in a landmark --}}
            @yield('cta')
        @else
            @yield('content')
        @endisset
    </main>

    <x-partials.footer-bottom />
    {{-- Floating buttons, grouped in a named landmark --}}
    <aside aria-label="{{ __('strings.quick_actions_label') }}">
        <x-partials-br.back-to-top-btn />
        <x-partials-br.chat-btn-wa />
    </aside>
    <x-partials.cookie-consent />
</body>

</html>
