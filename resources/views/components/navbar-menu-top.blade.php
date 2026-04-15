{{-- HEADER --}}
<header class="z-99999 fixed top-0 w-full" x-data="{ mobileOpen: false }"
    x-effect="document.body.style.overflow = (mobileOpen && window.innerWidth < 1024) ? 'hidden' : ''"
    @keydown.escape.window="mobileOpen = false">
    {{-- NAVBAR ROW WITH NAVIGATION --}}
    <div class="aquarius-navbar-main">
        <nav class="aquarius-navbar-container">
            <div class="navbar-mobile">
                <a class="brand navbar-brand" href="{{ route('homepage') }}" aria-label="Aquarius Swimming Pools">
                    <img class="aquarius-logo" src="{{ asset('assets/favicon/aquarius-logo-192.png') }}" alt="Aquarius Swimming Pools">
                    <div class="aquarius-branding-name">
                        <span class="name-1">Aquarius</span><span class="name-2">Swimming Pools</span>
                    </div>
                </a>

                {{-- HAMBURGER BTN --}}
                <button type="button" class="navbar-btn-close"
                    :aria-expanded="mobileOpen"
                    aria-label="Toggle navigation"
                    @click="mobileOpen = !mobileOpen">

                    <svg x-show="!mobileOpen" class="shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>

                    <svg x-show="mobileOpen" class="shrink-0" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                    <span class="sr-only">Toggle navigation</span>
                </button>
                {{-- HAMBURGER BTN --}}
            </div>

            {{-- NAVIGATION --}}
            <div class="aquarius-navbar-nav"
                x-show="mobileOpen || window.innerWidth >= 1024"
                x-transition:enter="slide-in-top"
                x-cloak
                @resize.window="if (window.innerWidth >= 1024) mobileOpen = false">
                <div class="aquarius-nav-main">
                    <div class="nav-flex">
                        <div class="nav-content">
                            <div class="nav-content-details">
                                <a class="nav-link {{ Route::currentRouteName() === 'homepage' ? 'nav-link-active' : '' }}"
                                    href="{{ route('homepage') }}" aria-current="page">
                                    {{__('strings.navbar_homepage')}}
                                </a>

                                {{-- DROPDOWN: OUR POOLS --}}
                                <div class="nav-dropdown" x-data="{ open: false }" @click.outside="open = false">
                                    <button type="button" class="nav-dropdown-btn"
                                        :aria-expanded="open"
                                        @click="open = !open">
                                        {{__('strings.navbar_our_pools')}}
                                        <svg class="nav-dropdown-chevron"
                                            :style="open ? 'transform: rotate(-180deg)' : ''"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>
                                    </button>

                                    <div class="nav-dropdown-menu" x-show="open" x-cloak role="menu" aria-orientation="vertical">
                                        <div class="py-1 space-y-0.5">
                                            <a class="nav-link {{ Route::currentRouteName() === 'concrete-pools-page' ? 'nav-link-active' : '' }}"
                                                href="{{ route('concrete-pools-page') }}">
                                                {{__('strings.navbar_our_pools_concrete')}}
                                            </a>

                                            <a class="nav-link {{ Route::currentRouteName() === 'vinyl-pools-page' ? 'nav-link-active' : '' }}"
                                                href="{{ route('vinyl-pools-page') }}">
                                                {{__('strings.navbar_our_pools_vinyl')}}
                                            </a>

                                            <a class="nav-link {{ Route::currentRouteName() === 'fibreglass-pools-page' ? 'nav-link-active' : '' }}"
                                                href="{{ route('fibreglass-pools-page') }}">
                                                {{__('strings.navbar_our_pools_fibreglass')}}
                                            </a>

                                            <a class="nav-link" href="{{ route('our-pools-main') }}#compare">
                                                {{__('strings.navbar_our_pools_compare')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {{-- DROPDOWN: OUR POOLS --}}


                                <a class="nav-link {{ Route::currentRouteName() === 'pool-showcase-gallery' ? 'nav-link-active' : '' }}"
                                    href="{{ route('pool-showcase-gallery') }}">
                                    {{__('strings.navbar_pool_showcase')}}
                                </a>

                                {{-- DROPDOWN: OUR SERVICES --}}
                                <div class="nav-dropdown" x-data="{ open: false }" @click.outside="open = false">
                                    <button type="button" class="nav-dropdown-btn"
                                        :aria-expanded="open"
                                        @click="open = !open">
                                        {{__('strings.navbar_our_services')}}
                                        <svg class="nav-dropdown-chevron"
                                            :style="open ? 'transform: rotate(-180deg)' : ''"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>
                                    </button>

                                    <div class="nav-dropdown-menu" x-show="open" x-cloak role="menu" aria-orientation="vertical">
                                        <div class="py-1 space-y-0.5">
                                            <a class="nav-link {{ Route::currentRouteName() === 'pool-services-page' ? 'nav-link-active' : '' }}"
                                                href="{{ route('pool-services-page') }}">
                                                {{__('strings.navbar_our_services_pool')}}
                                            </a>

                                            <a class="nav-link {{ Route::currentRouteName() === 'pool-items-page' ? 'nav-link-active' : '' }}"
                                                href="{{ route('pool-items-page') }}">
                                                {{__('strings.navbar_our_services_essential')}}
                                            </a>

                                            <a class="nav-link" href="https://thesplashshop.com/">
                                                {{__('strings.navbar_our_services_supplies')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {{-- DROPDOWN: OUR SERVICES --}}

                                <a class="nav-link {{ Route::currentRouteName() === 'contact-page' ? 'nav-link-active' : '' }}"
                                    href="{{ route('contact-page') }}">
                                    {{__('strings.navbar_contact')}}
                                </a>
                            </div>
                        </div>

                        <div class="side-nav-content">
                            {{-- GET A QUOTE BTN --}}
                            <div class="nav-get-quote">
                                <a href="/#contact" class="quote-btn">
                                    {{__('strings.navbar_get_quote')}}
                                </a>
                            </div>
                            {{-- GET A QUOTE BTN --}}

                            {{-- LANGUAGE SELECTOR --}}
                            <div class="aquarius-lang-select" x-data="{ open: false }" @click.outside="open = false">
                                <button type="button" class="aquarius-lang-select-btn"
                                    :aria-expanded="open"
                                    @click="open = !open">

                                    <x-flag-icons :lang="app()->getLocale()" class="inline-block" />

                                    @if (app()->getLocale() === 'en_MY')
                                        <span class="lg:hidden max-lg:grow max-lg:text-left">Language: EN (English)</span>
                                        <span class="hidden lg:block">EN</span>
                                    @else
                                        <span class="lg:hidden max-lg:grow max-lg:text-left">Bahasa: MS (Melayu)</span>
                                        <span class="hidden lg:block">MS</span>
                                    @endif

                                    <svg class="size-4 transition-transform duration-200"
                                        :class="open ? 'rotate-180' : ''"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </button>

                                <div x-show="open" x-cloak class="aquarius-lang-select-dropdown"
                                    role="menu" aria-orientation="vertical">
                                    <div class="lang-select-dropdown-card">
                                        <form action="{{ url('/change-language') }}" method="POST" id="languageFormEn">
                                            @csrf
                                            <button type="submit" name="language" value="en"
                                                class="aquarius-lang-select-item">
                                                <x-flag-icons lang="en_MY" /> <span class="text-gray-500">EN</span> English
                                            </button>
                                        </form>

                                        <form action="{{ url('/change-language') }}" method="POST" id="languageFormMs">
                                            @csrf
                                            <button type="submit" name="language" value="ms"
                                                class="aquarius-lang-select-item">
                                                <x-flag-icons lang="ms_MY" /> <span class="text-gray-500">MS</span> Melayu
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- LANGUAGE SELECTOR --}}
                        </div>

                    </div>
                </div>
            </div>
            {{-- NAVIGATION --}}
        </nav>
    </div>

    {{-- ANNOUCEMENT BANNER --}}
    <x-navbar-annoucement-banner />

</header>
