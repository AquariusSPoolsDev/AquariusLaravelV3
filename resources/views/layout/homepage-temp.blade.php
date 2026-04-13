{{-- HOMEPAGE TEMPLATE. ONLY APPLIES TO HOMEPAGE --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <x-head-metadata />
    </head>
    <body class="antialiased scroll-mt-20 lg:scroll-mt-[5.5rem]">
        <x-navbar-menu-top />
        <div class="mt-20 lg:mt-[5.5rem]">
            @yield('content')
        </div>
        <x-footer-bottom />
        <x-back-to-top-btn />
        <x-chat-btn-wa />
    </body>
</html>
