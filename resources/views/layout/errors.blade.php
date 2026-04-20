<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('code') — @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Lato:ital,wght@0,300;0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-primary-50 min-h-screen flex flex-col items-center justify-center px-4">

    <div class="">

        {{-- Logo + Branding --}}
        <a href="{{ route('homepage') }}" class="brand navbar-brand inline-flex items-center gap-3 mb-10 justify-center"
            aria-label="Aquarius Swimming Pools">
            <x-reusables.logo />
        </a>

        <div class="text-center">
            {{-- Error Code --}}
            <h1 class="font-heading font-bold text-8xl lg:text-9xl text-primary-800 mb-4">@yield('code')</h1>

            {{-- Message --}}
            <p class="text-neutral-600 text-lg lg:text-xl max-w-md mx-auto mb-10">@yield('message')</p>

            {{-- Buttons --}}
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('homepage') }}"
                    class="py-2.5 px-5.5 inline-flex items-center gap-2 font-bold rounded-lg transition-all text-white bg-primary hover:bg-primary-700 active:bg-primary-800 active:scale-95 focus:outline-none focus:bg-primary-700 cursor-pointer">
                    Back to Homepage
                </a>
                <a href="{{ route('contact-page') }}"
                    class="py-2.5 px-5.5 inline-flex items-center gap-2 font-bold rounded-lg transition-all border border-neutral-300 bg-white text-neutral-700 hover:bg-neutral-50 hover:border-neutral-400 active:scale-95 focus:outline-none cursor-pointer">
                    Contact Us
                </a>
            </div>
        </div>

    </div>

</body>

</html>