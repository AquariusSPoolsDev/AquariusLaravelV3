{{-- HEADER --}}
<header class="z-[99999] fixed top-0 w-full">
    {{-- NAVBAR ROW WITH NAVIGATION --}}
    <div class="aquarius-navbar-main">
        <nav class="aquarius-navbar-content-area">
            <div class="navbar-mobile">
                <a class="navbar-brand" href="{{ route('homepage') }}" aria-label="Brand">
                    <div class="w-16 h-16 rounded-full bg-blue-500 mr-2">
                        <img class="w-auto h-auto" src="{{ asset('assets/favicon/aquarius-logo-192.png') }}" alt="Aquarius Swimming Pools">
                    </div>
                    <div class="flex flex-col text-secondary-900 uppercase font-heading">
                        <div class="text-3xl">Aquarius</div>
                        <div class="text-lg -mt-2">Swimming Pools</div>
                    </div>
                </a>

                {{-- COLLAPSE BTN --}}
                <button type="button"
                    class="hs-collapse-toggle navbar-btn-close" id="hs-header-base-collapse"
                    aria-expanded="false" aria-controls="hs-header-base"
                    aria-label="Toggle navigation" data-hs-collapse="#hs-header-base">

                    <svg class="hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>

                    <svg class="hs-collapse-open:block shrink-0 hidden size-4" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                    <span class="sr-only">Toggle navigation</span>
                </button>
                {{-- COLLAPSE BTN --}}
            </div>

            {{-- NAVIGATION --}}
            <div id="hs-header-base" class="hs-collapse hidden aquarius-navbar-nav" aria-labelledby="hs-header-base-collapse">
                <div class="aquarius-nav-main">
                    <div class="nav-flex">
                        <div class="nav-content">
                            <div class="nav-content-details">
                                <a class="nav-link {{ Route::currentRouteName() === 'homepage' ? 'nav-link-active' : '' }}"
                                    href="{{ route('homepage') }}" aria-current="page">
                                    {{__('strings.navbar_homepage')}}
                                </a>

                                {{-- DROPDOWN CONTENT --}}
                                <div class="hs-dropdown [--strategy:static] lg:[--strategy:fixed] [--adaptive:none] [--is-collapse:true] lg:[--is-collapse:false] ">
                                    <button id="hs-header-base-dropdown" type="button"
                                        class="hs-dropdown-toggle w-full p-2 lg:px-3 flex items-center text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 "
                                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                        {{__('strings.navbar_our_pools')}}
                                        <svg class="hs-dropdown-open:-rotate-180 lg:hs-dropdown-open:rotate-0 duration-300 shrink-0 size-4 ms-auto lg:ms-1"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>
                                    </button>

                                    <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] lg:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative w-full lg:w-60 hidden z-10 top-full ps-7 lg:ps-0 lg:bg-white lg:rounded-lg lg:shadow-md before:absolute before:-top-4 before:start-0 before:w-full before:h-5 lg:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100"
                                        role="menu" aria-orientation="vertical"
                                        aria-labelledby="hs-header-base-dropdown">
                                        <div class="py-1 lg:px-1 space-y-0.5">
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
                                            <a class="nav-link"
                                                href="{{ route('our-pools-main') }}#compare">
                                                {{__('strings.navbar_our_pools_compare')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {{-- DROPDOWN CONTENT --}}


                                <a class="nav-link {{ Route::currentRouteName() === 'pool-showcase-gallery' ? 'nav-link-active' : '' }}"
                                    href="{{ route('pool-showcase-gallery') }}">
                                    {{__('strings.navbar_pool_showcase')}}
                                </a>

                                {{-- DROPDOWN CONTENT --}}
                                <div class="hs-dropdown [--strategy:static] lg:[--strategy:fixed] [--adaptive:none] [--is-collapse:true] lg:[--is-collapse:false] ">
                                    <button id="hs-header-base-dropdown" type="button"
                                        class="nav-dropdown-btn"
                                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                        {{__('strings.navbar_our_services')}}
                                        <svg class="hs-dropdown-open:-rotate-180 lg:hs-dropdown-open:rotate-0 duration-300 shrink-0 size-4 ms-auto lg:ms-1"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>
                                    </button>

                                    <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] lg:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative w-full lg:w-60 hidden z-10 top-full ps-7 lg:ps-0 lg:bg-white lg:rounded-lg lg:shadow-md before:absolute before:-top-4 before:start-0 before:w-full before:h-5 lg:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100" role="menu" aria-orientation="vertical" aria-labelledby="hs-header-base-dropdown">
                                        <div class="py-1 lg:px-1 space-y-0.5">
                                            <a class="nav-link {{ Route::currentRouteName() === 'pool-services-page' ? 'nav-link-active' : '' }}"
                                                href="{{ route('pool-services-page') }}">
                                                {{__('strings.navbar_our_services_pool')}}
                                            </a>

                                            <a class="nav-link {{ Route::currentRouteName() === 'pool-items-page' ? 'nav-link-active' : '' }}"
                                                href="{{ route('pool-items-page') }}">
                                                {{__('strings.navbar_our_services_essential')}}
                                            </a>

                                            <a class="nav-link"
                                                href="https://thesplashshop.com/">
                                                {{__('strings.navbar_our_services_supplies')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {{-- DROPDOWN CONTENT --}}

                                <a class="nav-link {{ Route::currentRouteName() === 'contact-page' ? 'nav-link-active' : '' }}"
                                    href="{{ route('contact-page') }}">
                                    {{__('strings.navbar_contact')}}
                                </a>
                            </div>
                        </div>

                        {{-- DIVIDER --}}
                        <div class="nav-divider">
                            <div class="nav-divider-line">
                            </div>
                        </div>
                        {{-- DIVIDER --}}

                        {{-- GET A QUOTE BTN --}}
                        <div class="nav-get-quote">
                            <a href="/#contact" class="quote-btn">
                                {{__('strings.navbar_get_quote')}}
                            </a>
                        </div>
                        {{-- GET A QUOTE BTN --}}

                        {{-- LANGUAGE SELECTOR --}}
                        <div class="hs-dropdown aquarius-lang-select">
                            <button id="aquarius-lang-selector" type="button"
                                class="hs-dropdown-toggle aquarius-lang-select-btn" aria-haspopup="menu"
                                aria-expanded="false" aria-label="Dropdown">

                                <x-flag-icons :lang="app()->getLocale()" class="inline-block" />

                                @if (app()->getLocale() === 'en_MY')
                                    <span class="lg:hidden max-lg:grow max-lg:text-left">Language: EN (English)</span> 
                                    <span class="hidden lg:block">EN</span>
                                @else
                                    <span class="lg:hidden max-lg:grow max-lg:text-left">Bahasa: MS (Melayu)</span> 
                                    <span class="hidden lg:block">MS</span>
                                @endif

                                <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div class="hs-dropdown-menu transition-[opacity, margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden aquarius-lang-select-dropdown"
                                role="menu" aria-orientation="vertical" aria-labelledby="aquarius-lang-selector">
                                <div class="lang-select-dropdown-card">
                                    <!-- Language options -->
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
                    </div>
                </div>
            </div>
            {{-- NAVIGATION --}}
        </nav>
    </div>

    {{-- ANNOUCEMENT BANNER --}}
    <x-navbar-annoucement-banner />

</header>