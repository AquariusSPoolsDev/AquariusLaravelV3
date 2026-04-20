{{-- HOMEPAGE TEMPLATE. ONLY APPLIES TO HOMEPAGE --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <x-partials.head-metadata />
    </head>
    <body class="antialiased scroll-mt-22 lg:scroll-mt-25">
        <x-partials.navbar-menu-top />
        
        <main class="mt-22 lg:mt-25 text-base lg:text-lg">
            @yield('content')
        </main>

        <x-partials.footer-bottom />
        <x-partials-br.back-to-top-btn />
        <x-partials-br.chat-btn-wa />
    </body>
</html>
