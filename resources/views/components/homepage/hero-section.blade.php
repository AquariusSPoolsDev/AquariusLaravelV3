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
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

            <button id="play-pause-btn" onclick="togglePlay()"
                class="hero-video-toggle-btn cursor-pointer">
                <span id="play-pause-icon">
                    <svg id="icon-pause" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M216,48V208a16,16,0,0,1-16,16H160a16,16,0,0,1-16-16V48a16,16,0,0,1,16-16h40A16,16,0,0,1,216,48ZM96,32H56A16,16,0,0,0,40,48V208a16,16,0,0,0,16,16H96a16,16,0,0,0,16-16V48A16,16,0,0,0,96,32Z"></path></svg>
                    <svg id="icon-play" class="hidden h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M240,128a15.74,15.74,0,0,1-7.6,13.51L88.32,229.65a16,16,0,0,1-16.2.3A15.86,15.86,0,0,1,64,216.13V39.87a15.86,15.86,0,0,1,8.12-13.82,16,16,0,0,1,16.2.3L232.4,114.49A15.74,15.74,0,0,1,240,128Z"></path></svg>
                </span>
                <span id="play-pause-text" class="ml-2 text-sm">Pause</span>
            </button>
        </div>


        <script>
            const video = document.getElementById('background-video');
            const playPauseText = document.getElementById('play-pause-text');
            const iconPause = document.getElementById('icon-pause');
            const iconPlay = document.getElementById('icon-play');

            // Respect OS-level reduced motion preference — pause video on load if set
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                video.pause();
                iconPause.classList.add('hidden');
                iconPlay.classList.remove('hidden');
                playPauseText.textContent = 'Play';
            }

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
                <ul class="flex flex-wrap justify-center gap-2 mb-4 max-w-xl" data-animate data-delay="250" aria-label="Key features">
                    <li class="aquarius-feature-pill">{{ __('strings.hero_feature_1') }}</li>
                    <li class="aquarius-feature-pill">{{ __('strings.hero_feature_2') }}</li>
                    <li class="aquarius-feature-pill">{{ __('strings.hero_feature_3') }}</li>
                    <li class="aquarius-feature-pill">{{ __('strings.hero_feature_4') }}</li>
                    <li class="aquarius-feature-pill">{{ __('strings.hero_feature_5') }}</li>
                </ul>

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
                    @php
                    $heroAlts = [
                        1 => 'Aquarius Pools completed commercial pool in Tanjung Leman',
                        2 => 'Aquarius Pools completed residential infinity concrete pool type',
                        3 => 'Aquarius Pools vinyl pool completion at a residential home',
                        4 => 'Vinyl pool view from the indoor area',
                        5 => 'Aerial view of a fountain field in a public housing area',
                    ];
                    @endphp
                    @foreach ([1,2,3,4,5] as $n)
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="{{ asset('assets/images/hero-image/webp/hero-image-' . $n . '.webp') }}" type="image/webp">
                            {{-- Slide 1 is above the fold — eager load to avoid LCP penalty --}}
                            <img loading="{{ $n === 1 ? 'eager' : 'lazy' }}" src="{{ asset('assets/images/hero-image/hero-image-' . $n . '.jpg') }}" alt="{{ $heroAlts[$n] }}" title="{{ $heroAlts[$n] }}">
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
                    <img loading="lazy" src="{{ asset('assets/images/hero-image/hero-image-4.jpg') }}" alt="Vinyl pool view from the indoor area" title="Vinyl pool view from the indoor area">
                </picture>
            </div>
            <div class="hero-strip-card hero-strip-card-left" data-animate data-delay="500">
                <picture>
                    <source srcset="{{ asset('assets/images/hero-image/webp/hero-image-2.webp') }}" type="image/webp">
                    <img loading="lazy" src="{{ asset('assets/images/hero-image/hero-image-2.jpg') }}" alt="Aquarius Pools completed residential infinity concrete pool type" title="Aquarius Pools completed residential infinity concrete pool type">
                </picture>
            </div>
            <div class="hero-strip-card hero-strip-card-center" data-animate data-delay="550">
                <picture>
                    <source srcset="{{ asset('assets/images/hero-image/webp/hero-image-1.webp') }}" type="image/webp">
                    {{-- Center strip is the largest visible image above the fold — eager load to avoid LCP penalty --}}
                    <img loading="eager" src="{{ asset('assets/images/hero-image/hero-image-1.jpg') }}" alt="Aquarius Pools completed commercial pool in Tanjung Leman" title="Aquarius Pools completed commercial pool in Tanjung Leman">
                </picture>
            </div>
            <div class="hero-strip-card hero-strip-card-right" data-animate data-delay="500">
                <picture>
                    <source srcset="{{ asset('assets/images/hero-image/webp/hero-image-3.webp') }}" type="image/webp">
                    <img loading="lazy" src="{{ asset('assets/images/hero-image/hero-image-3.jpg') }}" alt="Aquarius Pools vinyl pool completion at a residential home" title="Aquarius Pools vinyl pool completion at a residential home">
                </picture>
            </div>
            <div class="hero-strip-card hero-strip-card-far-right" data-animate data-delay="450">
                <picture>
                    <source srcset="{{ asset('assets/images/hero-image/webp/hero-image-5.webp') }}" type="image/webp">
                    <img loading="lazy" src="{{ asset('assets/images/hero-image/hero-image-5.jpg') }}" alt="Aerial view of a fountain field in a public housing area" title="Aerial view of a fountain field in a public housing area">
                </picture>
            </div>
        </div>
    </div>

</section>
