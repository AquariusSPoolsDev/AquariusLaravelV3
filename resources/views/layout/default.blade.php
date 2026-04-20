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
    <main class="mt-22 lg:mt-25 text-base lg:text-lg">
        {{-- PAGE HEADER TITLE --}}
        <x-reusables.page-header :headerTitle="$headerTitle" :headerSubtitle="$headerSubtitle" :imageFileLoc="$imageFileLoc" />

        {{-- MAIN CONTAINER --}}
        <article class="main-container">
            @yield('content')
        </article>
    </main>

    <x-partials.footer-bottom />
    <x-partials-br.back-to-top-btn />
    <x-partials-br.chat-btn-wa />
</body>

</html>