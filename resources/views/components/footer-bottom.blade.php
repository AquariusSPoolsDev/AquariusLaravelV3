<!-- ========== FOOTER ========== -->
<footer class="aquarius-footer">
    <div class="aquarius-container-content">
        <!-- Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-6 gap-4 lg:gap-6 mb-10">
            <div class="col-span-full hidden lg:col-span-2 lg:block">
                <a class="brand footer-brand" href="{{ route('homepage') }}" aria-label="Aquarius Swimming Pools">
                    <img class="aquarius-logo" src="{{ asset('assets/favicon/aquarius-logo-192.png') }}"
                        alt="Aquarius Swimming Pools">
                    <div class="aquarius-branding-name">
                        <span class="name-1 text-white">Aquarius</span><span class="name-2 text-white">Swimming Pools</span>
                    </div>
                </a>

                <p class="mt-3 text-neutral-400">
                    © {{ date('Y') }} Aquarius Swimming Pools Sdn Bhd.
                </p>

                <div class="mt-8 me-12">
                    <address class="not-italic text-sm">
                        <p class="text-base uppercase font-bold text-white">Aquarius Swimming Pools Sdn Bhd &lpar;920548-M&rpar;</p>
                        <p class="text-neutral-400">33, Jalan Selatan 3/4, Taman Impian Emas,<br>81300 Skudai, Johor, Malaysia</p>
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

                    <p><a class="aquarius-footer-links" href="{{ route('our-pools-main') }}#compare">{{__('strings.footer_our_pools_compare')}}</a>
                    </p>
                </div>
            </div>

            {{-- SECOND RIGHT COLUMN --}}
            <div>
                <h4 class="aquarius-footer-heading">{{__('strings.footer_our_services')}}</h4>

                <div class="mt-4 flex flex-col gap-y-4">
                    <p><a class="aquarius-footer-links" href="{{ route('pool-services-page') }}">{{__('strings.footer_our_services_pool')}}</a></p>

                    <p><a class="aquarius-footer-links" href="{{ route('pool-items-page') }}">{{__('strings.footer_our_services_essential')}}</a></p>

                    <p><a class="aquarius-footer-links" href="https://thesplashshop.com/">{{__('strings.footer_our_services_supplies')}}</a></p>
                </div>
            </div>

            {{-- THIRD RIGHT COLUMN --}}
            <div>
                <h4 class="aquarius-footer-heading">{{__('strings.footer_contact_title')}}</h4>

                <div class="mt-4 flex flex-col gap-y-4">
                    <p><a class="aquarius-footer-links" href="{{ route('contact-page') }}">{{__('strings.footer_contact')}}</a></p>

                    <p><a class="aquarius-footer-links" href="{{ route('faq-page') }}">{{__('strings.footer_faq')}}</a>
                    </p>
                </div>
            </div>

            {{-- FOURTH RIGHT COLUMN --}}
            <div>
                <h4 class="aquarius-footer-heading">{{__('strings.footer_extra')}}</h4>

                <div class="mt-4 flex flex-col gap-y-4">
                    <p><a class="aquarius-footer-links" href="{{ route('pool-showcase-gallery') }}">{{__('strings.footer_pool_showcase')}}</a></p>

                    <p><a class="aquarius-footer-links" href="{{ route('customer-reviews-page') }}">{{__('strings.footer_reviews')}}</a></p>

                    <p><a class="aquarius-footer-links" href="{{ route('promo-page') }}">{{__('strings.footer_promotion')}}</a></p>
                </div>
            </div>
        </div>

        {{-- BOTTOM ROW --}}
        <div class="bottom-row">
            <div class="flex gap-y-4 max-lg:flex-col justify-center lg:justify-between">
                <div class="flex flex-wrap items-center gap-3 max-lg:order-3">
                    <div class="space-x-4">
                        <a class="aquarius-footer-links"
                            href="{{ route('terms-page') }}">{{__('strings.footer_terms')}}</a>
                        <a class="aquarius-footer-links"
                            href="{{ route('privacy-page') }}">{{__('strings.footer_privacy')}}</a>
                    </div>
                </div>

                <div class="flex flex-wrap justify-between items-center gap-4 max-lg:order-1">
                    <div class="mt-3 max-lg:block hidden">
                        <a class="brand footer-brand" href="{{ route('homepage') }}"
                            aria-label="Aquarius Swimming Pools">
                            <img class="aquarius-logo" src="{{ asset('assets/favicon/aquarius-logo-192.png') }}"
                                alt="Aquarius Swimming Pools">
                            <div class="aquarius-branding-name">
                                <span class="name-1 text-white">Aquarius</span><span class="name-2 text-white">Swimming Pools</span>
                            </div>
                        </a>
                        <p class="mt-2 text-neutral-400 text-sm"> © {{ date('Y') }} Aquarius Swimming Pools.</p>
                    </div>

                    {{-- SOCIAL LINKS --}}
                    <div class="flex gap-x-1" role="list" aria-label="Social media links">
                        <a href="https://facebook.com/AquariusSwimmingPools" class="aquarius-social-icons"
                            aria-label="Visit us on Facebook" role="listitem">
                            <i class="fa-brands fa-facebook" aria-hidden="true"></i>
                        </a>

                        <a href="https://instagram.com/aquariusswimmingpools" class="aquarius-social-icons"
                            aria-label="Follow us on Instagram" role="listitem">
                            <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                        </a>

                        <a href="https://www.tiktok.com/@aquariuspools" class="aquarius-social-icons"
                            aria-label="Follow us on TikTok" role="listitem">
                            <i class="fa-brands fa-tiktok" aria-hidden="true"></i>
                        </a>

                        <a href="https://wa.me/60125105126" class="aquarius-social-icons"
                            aria-label="Chat us via WhatsApp" role="listitem">
                            <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                        </a>

                        <a href="/" class="aquarius-social-icons"
                            aria-label="Subscribe on YouTube" role="listitem">
                            <i class="fa-brands fa-youtube" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <div class="lg:hidden max-lg:order-2">
                    <address class="not-italic text-sm">
                        <p class="text-base uppercase font-bold text-white">Aquarius Swimming Pools Sdn Bhd &lpar;920548-M&rpar;</p>
                        <p class="text-neutral-400">33, Jalan Selatan 3/4, Taman Impian Emas,<br>81300 Skudai, Johor, Malaysia</p>
                    </address>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PH2GPHF" height="0" width="0"
        style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->