<section class="aquarius-hero-page-content-section">
    <video id="background-video" autoplay muted loop class="hero-video-bg">
        <source src="{{ asset('assets/videos/aquarius-homepage-hero-video.mp4') }}" type="video/mp4">
        {{ __('strings.video_player') }}
    </video>
    <div class="hero-video-overlay"></div>

    <div class="hero-video-toggle">
        <div class="flex gap-3 items-center m-auto">
            <div x-data="{ show: true }" x-show="show" class="hero-video-toast" role="alert" tabindex="-1">
                <div class="flex p-1 px-3 gap-2">
                    <p class="hero-video-toast-label">
                        Toggle autoplay
                    </p>

                    <div class="ms-auto">
                        <button type="button" class="toast-close-btn" aria-label="Close" @click="show = false">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <button id="play-pause-btn" onclick="togglePlay()"
                class="hero-video-toggle-btn cursor-pointer">
                <span id="play-pause-icon">
                    <svg id="icon-pause" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="14" y="3" width="5" height="18" rx="1"/><rect x="5" y="3" width="5" height="18" rx="1"/></svg>
                    <svg id="icon-play" class="hidden h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 5a2 2 0 0 1 3.008-1.728l11.997 6.998a2 2 0 0 1 .003 3.458l-12 7A2 2 0 0 1 5 19z"/></svg>
                </span>
                <span id="play-pause-text" class="ml-2 text-sm">Pause</span>
            </button>
        </div>


        <script>
            const video = document.getElementById('background-video');
            const playPauseText = document.getElementById('play-pause-text');
            const iconPause = document.getElementById('icon-pause');
            const iconPlay = document.getElementById('icon-play');

            function togglePlay() {
                if (video.paused) {
                    video.play();
                    iconPause.classList.remove('hidden');
                    iconPlay.classList.add('hidden');
                    playPauseText.textContent = 'Pause';
                } else {
                    video.pause();
                    iconPause.classList.add('hidden');
                    iconPlay.classList.remove('hidden');
                    playPauseText.textContent = 'Play';
                }
            }
        </script>
    </div>
    <div class="aquarius-hero-contents">
        <div class="aquarius-left-hero-content">
            <div class="left-content-gap-small">
                <h1 class="aquarius-main-heading" data-animate data-delay="0">
                    {{ __('strings.hero_heading') }}
                </h1>
                <p class="aquarius-secondary-heading" data-animate data-delay="150">
                    {{ __('strings.hero_content') }}
                </p>
                <p class="aquarius-features-heading" data-animate data-delay="250">
                    <strong>{{ __('strings.hero_feature_1') }}</strong> |
                    <strong>{{ __('strings.hero_feature_2') }}</strong> |
                    <strong>{{ __('strings.hero_feature_3') }}</strong> |
                    <strong>{{ __('strings.hero_feature_4') }}</strong> |
                    <strong>{{ __('strings.hero_feature_5') }}</strong>
                </p>

                <div class="aquarius-cta-buttons" data-animate data-delay="350">
                    <a href="#contact" type="button" class="aquarius-cta-primary" title="{{ __('strings.hero_btn_quote') }}">
                        {{ __('strings.hero_btn_quote') }}
                    </a>
                    <a href="#our-pools" type="button" class="aquarius-cta-secondary" title="{{ __('strings.hero_btn_explore') }}">
                        {{ __('strings.hero_btn_explore') }}
                    </a>
                </div>
            </div>
        </div>

        {{-- Mobile Swiper (hidden on lg+) --}}
        <div class="hero-mobile-swiper-wrap lg:hidden">
            <div class="hero-mobile-swiper swiper">
                <div class="swiper-wrapper">
                    @foreach ([1,2,3,4,5] as $n)
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="{{ asset('assets/images/hero-image/webp/hero-image-' . $n . '.webp') }}" type="image/webp">
                            <img loading="lazy" src="{{ asset('assets/images/hero-image/hero-image-' . $n . '.jpg') }}" alt="Hero Image {{ $n }}">
                        </picture>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

        {{-- Strip images (lg+) --}}
        <div class="hero-strip-container">
            <div class="hero-strip-card hero-strip-card-far-left" data-animate data-delay="450">
                <picture>
                    <source srcset="{{ asset('assets/images/hero-image/webp/hero-image-4.webp') }}" type="image/webp">
                    <img loading="lazy" src="{{ asset('assets/images/hero-image/hero-image-4.jpg') }}" alt="Hero Image 4">
                </picture>
            </div>
            <div class="hero-strip-card hero-strip-card-left" data-animate data-delay="500">
                <picture>
                    <source srcset="{{ asset('assets/images/hero-image/webp/hero-image-2.webp') }}" type="image/webp">
                    <img loading="lazy" src="{{ asset('assets/images/hero-image/hero-image-2.jpg') }}" alt="Hero Image 2">
                </picture>
            </div>
            <div class="hero-strip-card hero-strip-card-center" data-animate data-delay="550">
                <picture>
                    <source srcset="{{ asset('assets/images/hero-image/webp/hero-image-1.webp') }}" type="image/webp">
                    <img loading="lazy" src="{{ asset('assets/images/hero-image/hero-image-1.jpg') }}" alt="Hero Image 1">
                </picture>
            </div>
            <div class="hero-strip-card hero-strip-card-right" data-animate data-delay="500">
                <picture>
                    <source srcset="{{ asset('assets/images/hero-image/webp/hero-image-3.webp') }}" type="image/webp">
                    <img loading="lazy" src="{{ asset('assets/images/hero-image/hero-image-3.jpg') }}" alt="Hero Image 3">
                </picture>
            </div>
            <div class="hero-strip-card hero-strip-card-far-right" data-animate data-delay="450">
                <picture>
                    <source srcset="{{ asset('assets/images/hero-image/webp/hero-image-5.webp') }}" type="image/webp">
                    <img loading="lazy" src="{{ asset('assets/images/hero-image/hero-image-5.jpg') }}" alt="Hero Image 5">
                </picture>
            </div>
        </div>
    </div>

</section>
