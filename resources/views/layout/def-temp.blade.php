{{-- DEFAULT TEMPLATE USED ON ALL PAGES --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <x-head-metadata />
    </head>
    <body class="antialiased scroll-mt-20 lg:scroll-mt-[5.5rem]">
        {{-- NAVBAR --}}
        <x-navbar-menu-top />

        {{-- MAIN CONTENT PAGE --}}
        <article class="mt-20 lg:mt-[5.5rem]">
            {{-- PAGE HEADER TITLE --}}
            <x-page-header-component :headerTitle="$headerTitle"  :headerSubtitle="$headerSubtitle" :imageFileLoc="$imageFileLoc" />

            {{-- MAIN CONTAINER --}}
            <div class="main-container">
                @yield('content')
            </div>
        </article>
        <x-footer-bottom />
        <x-back-to-top-btn />
        <x-chat-btn-wa />
    </body>
</html>
