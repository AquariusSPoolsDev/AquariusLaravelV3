{{-- HOMEPAGE TEMPLATE. ONLY APPLIES TO HOMEPAGE --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <x-head-metadata />
    </head>
    <body class="antialiased scroll-mt-22 lg:scroll-mt-25">
        <x-navbar-menu-top />
        
        <main class="mt-22 lg:mt-25 text-base lg:text-lg">
            @yield('content')
        </main>

        <x-footer-bottom />
        <x-back-to-top-btn />
        <x-chat-btn-wa />
    </body>
</html>
