{{-- DEFAULT TEMPLATE USED ON ALL PAGES --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <x-head-metadata />
</head>

<body class="antialiased scroll-mt-22 lg:scroll-mt-25">
    {{-- NAVBAR --}}
    <x-navbar-menu-top />

    {{-- MAIN CONTENT PAGE --}}
    <main class="mt-22 lg:mt-25 text-base lg:text-lg">
        {{-- PAGE HEADER TITLE --}}
        <x-page-header-component :headerTitle="$headerTitle" :headerSubtitle="$headerSubtitle"
            :imageFileLoc="$imageFileLoc" />

        {{-- MAIN CONTAINER --}}
        <article class="main-container">
            @yield('content')
        </article>
    </main>

    <x-footer-bottom />
    <x-back-to-top-btn />
    <x-chat-btn-wa />
</body>

</html>