<!-- ========== FOOTER ========== -->
<footer class="mt-auto w-full pt-10 pb-32 px-4 container mx-auto">
    <!-- Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-6 gap-4 mb-10">
        <div class="col-span-full hidden lg:col-span-2 lg:block">
            <a class="flex flex-row items-center font-semibold text-xl focus:outline-none focus:opacity-80 "
                href="{{ route('homepage') }}" aria-label="Brand">
                <div class="w-16 h-16 rounded-full bg-blue-500 mr-2">
                    <img class="w-auto h-auto" src="{{ asset('assets/favicon/aquarius-logo-192.png') }}" alt="Aquarius Swimming Pools">
                </div>
                <div class="flex flex-col text-secondary-900 uppercase font-heading">
                    <div class="text-3xl">Aquarius</div>
                    <div class="text-lg -mt-2">Swimming Pools</div>
                </div>
            </a>
            <p class="mt-3 text-gray-600">
                © {{ date('Y') }} Aquarius Swimming Pools.
            </p>

            <div class="mt-6 me-12">
                <address class="not-italic text-sm">
                    <h4 class="text-base uppercase font-bold text-gray-800">Aquarius Swimming Pools Sdn Bhd &lpar;920548-M&rpar;</h4>
                    <p class="text-gray-600">33, Jalan Selatan 3/4, Taman Impian Emas,<br>81300 Skudai, Johor, Malaysia</p>
                </address>
            </div>
        </div>

        {{-- FIRST RIGHT COLUMN --}}
        <div>
            <h4 class="aquarius-footer-heading">{{__('strings.footer_our_pools')}}</h4>

            <div class="mt-3 grid space-y-3">
                <p><a class="aquarius-footer-links" href="{{ route('concrete-pools-page') }}">{{__('strings.footer_our_pools_concrete')}}</a></p>

                <p><a class="aquarius-footer-links" href="{{ route('vinyl-pools-page') }}">{{__('strings.footer_our_pools_vinyl')}}</a></p>

                <p><a class="aquarius-footer-links" href="{{ route('fibreglass-pools-page') }}">{{__('strings.footer_our_pools_fibreglass')}}</a></p>

                <p><a class="aquarius-footer-links" href="{{ route('our-pools-main') }}#compare">{{__('strings.footer_our_pools_compare')}}</a></p>
            </div>
        </div>

        {{-- SECOND RIGHT COLUMN --}}
        <div>
            <h4 class="aquarius-footer-heading">{{__('strings.footer_our_services')}}</h4>

            <div class="mt-3 grid space-y-3">
                <p><a class="aquarius-footer-links" href="{{ route('pool-services-page') }}">{{__('strings.footer_our_services_pool')}}</a></p>

                <p><a class="aquarius-footer-links" href="{{ route('pool-items-page') }}">{{__('strings.footer_our_services_essential')}}</a></p>

                <p><a class="aquarius-footer-links" href="https://thesplashshop.com/">{{__('strings.footer_our_services_supplies')}}</a></p>
            </div>
        </div>

        {{-- THIRD RIGHT COLUMN --}}
        <div>
            <h4 class="aquarius-footer-heading">{{__('strings.footer_contact_title')}}</h4>

            <div class="mt-3 grid space-y-3">
                <p><a class="aquarius-footer-links" href="{{ route('contact-page') }}">{{__('strings.footer_contact')}}</a></p>

                <p><a class="aquarius-footer-links" href="{{ route('faq-page') }}">{{__('strings.footer_faq')}}</a></p>
            </div>
        </div>

        {{-- FOURTH RIGHT COLUMN --}}
        <div>
            <h4 class="aquarius-footer-heading">{{__('strings.footer_extra')}}</h4>

            <div class="mt-3 grid space-y-3">
                <p><a class="aquarius-footer-links" href="{{ route('pool-showcase-gallery') }}">{{__('strings.footer_pool_showcase')}}</a></p>

                <p><a class="aquarius-footer-links" href="{{ route('customer-reviews-page') }}">{{__('strings.footer_reviews')}}</a></p>

                <p><a class="aquarius-footer-links" href="{{ route('promo-page') }}">{{__('strings.footer_promotion')}}</a></p>
            </div>
        </div>
    </div>

    {{-- BOTTOM ROW --}}
    <div class="pt-5 mt-5 border-t border-gray-200">
        <div class="flex max-lg:flex-col justify-center lg:justify-between">
            <div class="flex flex-wrap items-center gap-3">

                <div class="space-x-4">
                    <a class="aquarius-footer-links" href="{{ route('terms-page') }}">{{__('strings.footer_terms')}}</a>
                    <a class="aquarius-footer-links" href="{{ route('privacy-page') }}">{{__('strings.footer_privacy')}}</a>
                </div>
            </div>

            <div class="flex flex-wrap justify-between items-center gap-4 max-lg:mt-6">
                <div class="mt-3 max-lg:block hidden">
                    <a class="flex flex-row items-center font-semibold text-xl text-black focus:outline-none focus:opacity-80 "
                    href="{{ route('homepage') }}" aria-label="Brand">
                        <div class="w-12 h-12 rounded-full bg-blue-500 mr-2">
                            <img class="w-auto h-auto" src="{{ asset('assets/favicon/aquarius-logo-192.png') }}" alt="Aquarius Swimming Pools">
                        </div>
                        <div class="flex flex-col text-secondary-900 uppercase">
                            <div class="text-2xl">Aquarius</div>
                            <div class="text-sm -mt-2">Swimming Pools</div>
                        </div>
                    </a>
                    <p class="mt-2 text-gray-600 text-sm"> © {{ date('Y') }} Aquarius Swimming Pools.</p>
                </div>

                {{-- SOCIAL LINKS --}}
                <div class="space-x-4">
                    <a href="https://facebook.com/AquariusSwimmingPools" class="aquarius-social-icons" title="Visit us on Facebook">
                        <i class="fa-brands fa-facebook"></i>
                        <div class="sr-only">Facebook</div>
                    </a>

                    <a href="https://instagram.com/aquariusswimmingpools" class="aquarius-social-icons" title="Follow us on Instagram">
                        <i class="fa-brands fa-instagram"></i>
                        <div class="sr-only">Instagram</div>
                    </a>

                    <a href="https://www.tiktok.com/@aquariuspools" class="aquarius-social-icons" title="Follow us on TikTok">
                        <i class="fa-brands fa-tiktok"></i>
                        <div class="sr-only">TikTok</div>
                    </a>

                    <a href="https://wa.me/60125105126" class="aquarius-social-icons" title="Chat us via WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                        <div class="sr-only">WhatsApp</div>
                    </a>

                    <a href="#" class="aquarius-social-icons" title="Subscribe us on YouTube">
                        <i class="fa-brands fa-youtube"></i>
                        <div class="sr-only">YouTube</div>
                    </a>
                </div>
            </div>

            <div class="mt-6 lg:hidden">
                <address class="not-italic text-sm">
                    <p class="text-gray-800 font-bold mb-3">{{__('strings.contact_showpool_address_title')}}</p>
                    <h4 class="text-base uppercase font-bold text-gray-800">Aquarius Swimming Pools Sdn Bhd &lpar;920548-M&rpar;</h4>
                    <p class="text-gray-600">33, Jalan Selatan 3/4, Taman Impian Emas,<br>81300 Skudai, Johor, Malaysia</p>
                </address>
            </div>
        </div>
    </div>
</footer>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PH2GPHF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
