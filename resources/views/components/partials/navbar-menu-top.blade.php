{{-- HEADER --}}
<header class="z-99999 fixed top-0 w-full" x-data="{ mobileOpen: false, isDesktop: window.innerWidth >= 1024 }"
    x-effect="document.body.style.overflow = (mobileOpen && window.innerWidth < 1024) ? 'hidden' : ''"
    @keydown.escape.window="mobileOpen = false">
    {{-- NAVBAR ROW WITH NAVIGATION --}}
    <div class="aquarius-navbar-main">
        <nav class="aquarius-navbar-container">
            <div class="navbar-mobile">
                <a class="brand navbar-brand" href="{{ route('homepage') }}" aria-label="Aquarius Swimming Pools">
                    <x-reusables.logo />
                </a>

                {{-- CLICK-TO-CALL (mobile only) --}}
                {{-- <a href="tel:+60125105126" class="lg:hidden flex items-center justify-center p-2 text-neutral-700 hover:text-primary-600 transition-colors" aria-label="Call Aquarius Swimming Pools" onclick="window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:'click_to_call',phone:'+60125105126',location:'navbar_mobile'})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 256 256" fill="currentColor"><path d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L134.87,160c-15.42-7.49-31.34-23.29-38.83-38.56l20.78-24.71c.2-.25.39-.5.57-.76a16,16,0,0,0,1.32-15.06l0-.12L97.54,33.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,32,80c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,222.37,158.46Z"/></svg>
                </a> --}}
                {{-- HAMBURGER BTN --}}
                <button type="button" class="navbar-btn-close"
                    :aria-expanded="mobileOpen"
                    aria-label="Toggle navigation"
                    @click="mobileOpen = !mobileOpen">

                    <svg x-show="!mobileOpen" class="shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256" fill="currentColor"><path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z"></path></svg>

                    <svg x-show="mobileOpen" class="shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256" fill="currentColor"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path></svg>
                    <span class="sr-only">Toggle navigation</span>
                </button>
                {{-- HAMBURGER BTN --}}
            </div>

            {{-- NAVIGATION --}}
            <div class="aquarius-navbar-nav"
                x-show="mobileOpen || isDesktop"
                x-transition:enter="slide-in-top"
                x-cloak
                @resize.window="isDesktop = window.innerWidth >= 1024; if (isDesktop) mobileOpen = false">
                <div class="aquarius-nav-main">
                    <div class="nav-flex">
                        <div class="nav-content">
                            <div class="nav-content-details">
                                @php
                                    $currentRoute = Route::currentRouteName();

                                    /*
                                     * Each dropdown lists only the pages switched on in Page Visibility; a dropdown with
                                     * nothing visible is left out. Links are plain links in a disclosure (not role="menu").
                                     * Each link: [SitePage, href, label, route names that mark it active].
                                     */
                                    $navGroups = [
                                        [
                                            'label' => __('strings.navbar_our_pools'),
                                            'links' => [
                                                [\App\Enums\SitePage::OurPools, route('our-pools-main').'#compare', __('strings.navbar_our_pools_compare'), ['our-pools-main']],
                                                [\App\Enums\SitePage::ConcretePools, route('concrete-pools-page'), __('strings.navbar_our_pools_concrete'), ['concrete-pools-page']],
                                                [\App\Enums\SitePage::VinylPools, route('vinyl-pools-page'), __('strings.navbar_our_pools_vinyl'), ['vinyl-pools-page']],
                                                [\App\Enums\SitePage::FibreglassPools, route('fibreglass-pools-page'), __('strings.navbar_our_pools_fibreglass'), ['fibreglass-pools-page']],
                                            ],
                                        ],
                                        [
                                            'label' => __('strings.navbar_our_work'),
                                            'links' => [
                                                [\App\Enums\SitePage::Showcase, route('pool-showcase-gallery'), __('strings.navbar_pool_showcase'), ['pool-showcase-gallery']],
                                                [\App\Enums\SitePage::Reviews, route('customer-reviews-page'), __('strings.navbar_reviews'), ['customer-reviews-page']],
                                                [\App\Enums\SitePage::Projects, route('projects-page'), __('strings.navbar_projects'), ['projects-page', 'project-detail-page']],
                                            ],
                                        ],
                                        [
                                            'label' => __('strings.navbar_our_services'),
                                            'links' => [
                                                [\App\Enums\SitePage::PoolServices, route('pool-services-page'), __('strings.navbar_our_services_pool'), ['pool-services-page']],
                                                [\App\Enums\SitePage::PoolItems, route('pool-items-page'), __('strings.navbar_our_services_essential'), ['pool-items-page']],
                                            ],
                                            'external' => ['https://thesplashshop.com/', __('strings.navbar_our_services_supplies')],
                                        ],
                                    ];
                                @endphp

                                {{-- Home is reached through the logo; About Us is retired (see unslop-practices.md) --}}

                                @foreach ($navGroups as $group)
                                    @php
                                        $visibleLinks = array_values(array_filter($group['links'], fn (array $link): bool => $link[0]->isVisible()));
                                        $isGroupActive = collect($visibleLinks)->contains(fn (array $link): bool => in_array($currentRoute, $link[3], true));
                                    @endphp

                                    @if ($visibleLinks !== [] || isset($group['external']))
                                    <div class="nav-dropdown" x-data="{ open: false }" @click.outside="open = false" @keydown.escape="open = false">
                                        <button type="button" class="nav-dropdown-btn {{ $isGroupActive ? 'nav-link-active' : '' }}"
                                            :aria-expanded="open"
                                            @click="open = !open">
                                            {{ $group['label'] }}
                                            <svg class="nav-dropdown-chevron"
                                                :style="open ? 'transform: rotate(-180deg)' : ''"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" aria-hidden="true"
                                                viewBox="0 0 256 256" fill="currentColor"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path></svg>
                                        </button>

                                        <div class="nav-dropdown-menu" x-show="open" x-cloak>
                                            <div class="py-1 space-y-0.5">
                                                @foreach ($visibleLinks as [$page, $href, $label, $routes])
                                                    @php $isActive = in_array($currentRoute, $routes, true); @endphp
                                                    <a class="nav-link {{ $isActive ? 'nav-link-active' : '' }}" href="{{ $href }}" @if ($isActive) aria-current="page" @endif>
                                                        {{ $label }}
                                                    </a>
                                                @endforeach

                                                @isset($group['external'])
                                                    <a class="nav-link inline-flex! items-center gap-1.5" href="{{ $group['external'][0] }}" target="_blank" rel="noopener">
                                                        {{ $group['external'][1] }}
                                                        <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor" aria-hidden="true"><path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"></path></svg>
                                                        <span class="sr-only">{{ __('strings.navbar_opens_new_tab') }}</span>
                                                    </a>
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach

                                {{-- VISIT SHOWROOM: the showroom block on the Contact page --}}
                                @if (\App\Enums\SitePage::ContactUs->isVisible())
                                <a class="nav-link {{ $currentRoute === 'contact-page' ? 'nav-link-active' : '' }}"
                                    href="{{ route('contact-page') }}#showpool" @if ($currentRoute === 'contact-page') aria-current="page" @endif>
                                    {{ __('strings.navbar_visit_showroom') }}
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="side-nav-content">
                            {{-- CLICK-TO-CALL (desktop) --}}
                            {{-- <a href="tel:+60125105126" class="hidden lg:flex items-center gap-1.5 text-base font-semibold text-neutral-700 hover:text-primary-600 transition-colors" aria-label="Call us" onclick="window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:'click_to_call',phone:'+60125105126',location:'navbar_desktop'})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 256 256" fill="currentColor"><path d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L134.87,160c-15.42-7.49-31.34-23.29-38.83-38.56l20.78-24.71c.2-.25.39-.5.57-.76a16,16,0,0,0,1.32-15.06l0-.12L97.54,33.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,32,80c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,222.37,158.46Z"/></svg>
                                +6012-510 5126
                            </a> --}}
                            {{-- GET A QUOTE BTN --}}
                            <div class="nav-get-quote">
                                <a href="{{ route('contact-page') }}?interest=Free+Pool+Assessment" class="quote-btn" onclick="window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:'book_assessment_click',location:'navbar'})">
                                    <span class="xl:hidden">{{__('strings.navbar_get_quote_short')}}</span>
                                    <span class="hidden xl:inline">{{__('strings.navbar_get_quote')}}</span>
                                </a>
                            </div>
                            {{-- GET A QUOTE BTN --}}

                            {{-- LANGUAGE SELECTOR --}}
                            @php
                                $currentPath = request()->getPathInfo();
                                $qs = request()->getQueryString() ? '?' . request()->getQueryString() : '';
                                $enUrl = preg_replace('#^/(en|ms)(/|$)#', '/en$2', $currentPath) . $qs;
                                $msUrl = preg_replace('#^/(en|ms)(/|$)#', '/ms$2', $currentPath) . $qs;
                                $isMs = app()->getLocale() === 'ms_MY';
                            @endphp
                            <div class="aquarius-lang-select" x-data="{ open: false }" @click.outside="open = false">
                                <button type="button" class="aquarius-lang-select-btn"
                                    :aria-expanded="open"
                                    @click="open = !open">

                                    <x-reusables.flag-icons :lang="app()->getLocale()" class="inline-block" />

                                    @if (!$isMs)
                                        <span class="lg:hidden max-lg:grow max-lg:text-left">Language: EN (English)</span>
                                        <span class="hidden lg:block">EN</span>
                                    @else
                                        <span class="lg:hidden max-lg:grow max-lg:text-left">Bahasa: MS (Melayu)</span>
                                        <span class="hidden lg:block">MS</span>
                                    @endif

                                    <svg class="size-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256" fill="currentColor"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path></svg>
                                </button>

                                <div x-show="open" x-cloak class="aquarius-lang-select-dropdown"
                                   >
                                    <div class="lang-select-dropdown-card">
                                        <a href="{{ $enUrl }}" class="aquarius-lang-select-item" onclick="window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:'language_switch',language:'en'})">
                                            <x-reusables.flag-icons lang="en_MY" /> <span class="text-gray-500">EN</span> English
                                        </a>
                                        <a href="{{ $msUrl }}" class="aquarius-lang-select-item" onclick="window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:'language_switch',language:'ms'})">
                                            <x-reusables.flag-icons lang="ms_MY" /> <span class="text-gray-500">MS</span> Melayu
                                        </a>
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

    {{-- SCROLL PROGRESS BAR --}}
    <div id="scroll-progress-bar" class="h-1 bg-secondary-400 origin-left" style="transform: scaleX(0); transition: transform 0.1s linear;"></div>

    {{-- ANNOUCEMENT BANNER --}}
    <x-partials.navbar-annoucement-banner />

</header>
