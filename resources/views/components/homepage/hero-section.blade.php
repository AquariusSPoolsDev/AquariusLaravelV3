<section class="aquarius-hero-page-content-section">
    <video id="background-video" autoplay muted loop class="hero-video-bg">
        <source src="{{ asset('assets/videos/aquarius-homepage-hero-video.mp4') }}" type="video/mp4">
        {{ __('strings.video_player') }}
    </video>
    <div class="hero-video-overlay"></div>

    <div class="hero-video-toggle">
        <div class="flex gap-3 items-center m-auto">
            <div id="dismiss-toast" class="hero-video-toast" role="alert" tabindex="-1"
                aria-labelledby="hs-toast-dismiss-button-label">
                <div class="flex p-1 px-3 gap-2">
                    <p id="hs-toast-dismiss-button-label" class="hero-video-toast-label">
                        Toggle autoplay
                    </p>

                    <div class="ms-auto">
                        <button type="button" class="toast-close-btn" aria-label="Close"
                            data-hs-remove-element="#dismiss-toast">
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
                class="hero-video-toggle-btn">
                <i id="play-pause-icon" class="fas fa-pause"></i>
                <span id="play-pause-text" class="ml-2 text-sm">Pause</span>
            </button>
        </div>


        <script>
            const video = document.getElementById('background-video');
            const playPauseBtn = document.getElementById('play-pause-btn');
            const playPauseIcon = document.getElementById('play-pause-icon');
            const playPauseText = document.getElementById('play-pause-text');

            function togglePlay() {
                if (video.paused) {
                    video.play();
                    playPauseIcon.classList.remove('fa-play');
                    playPauseIcon.classList.add('fa-pause');
                    playPauseText.textContent = 'Pause';
                } else {
                    video.pause();
                    playPauseIcon.classList.remove('fa-pause');
                    playPauseIcon.classList.add('fa-play');
                    playPauseText.textContent = 'Play';
                }
            }
        </script>
    </div>
    <div class="aquarius-hero-contents">
        <div class="aquarius-left-hero-content">
            <div class="left-content-gap-small">
                <h1 class="aquarius-main-heading">
                    {{ __('strings.hero_heading') }}
                </h1>
                <p class="aquarius-secondary-heading">
                    {{ __('strings.hero_content') }}
                </p>
                <p class="aquarius-features-heading">
                    <strong>{{ __('strings.hero_feature_1') }}</strong> |
                    <strong>{{ __('strings.hero_feature_2') }}</strong> |
                    <strong>{{ __('strings.hero_feature_3') }}</strong> |
                    <strong>{{ __('strings.hero_feature_4') }}</strong> |
                    <strong>{{ __('strings.hero_feature_5') }}</strong>
                </p>

                <div class="aquarius-cta-buttons">
                    <a href="#contact" type="button" class="aquarius-cta-primary">
                        {{ __('strings.hero_btn_quote') }}
                    </a>
                    <a href="#our-pools" type="button" class="aquarius-cta-secondary">
                        {{ __('strings.hero_btn_explore') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="aquarius-right-hero-content">
            <div
                class="aquarius-swiper-carousel swiper">
                <div class="swiper-wrapper">
                    <div class="aquarius-swiper-image swiper-slide" data-swiper-autoplay="4000">
                        <img loading="lazy" src="{{ asset('assets/images/aquarius-hero-image-1.jpg') }}" title="Hero Homepage Image 1" alt="Hero Homepage Image 1">
                    </div>
                    <div class="aquarius-swiper-image swiper-slide" data-swiper-autoplay="4000">
                        <img loading="lazy" src="{{ asset('assets/images/aquarius-hero-image-2.jpg') }}" title="Hero Homepage Image 2" alt="Hero Homepage Image 2">
                    </div>
                    <div class="aquarius-swiper-image swiper-slide" data-swiper-autoplay="4000">
                        <img loading="lazy" src="{{ asset('assets/images/aquarius-hero-image-3.jpg') }}" title="Hero Homepage Image 3" alt="Hero Homepage Image 3">
                    </div>
                    <div class="aquarius-swiper-image swiper-slide" data-swiper-autoplay="4000">
                        <img loading="lazy" src="{{ asset('assets/images/aquarius-hero-image-4.jpg') }}" title="Hero Homepage Image 4" alt="Hero Homepage Image 4">
                    </div>
                </div>

                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
    </div>

</section>
