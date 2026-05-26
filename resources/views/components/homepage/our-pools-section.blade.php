<section id="our-pools" class="bg-primary-50/50">
    <div class="main-container">
        <h2 class="aquarius-homepage-heading" data-animate data-delay="0">{{__('strings.pools_heading')}}</h2>

        <div class="aquarius-homepage-card-grid">
            {{-- Concrete --}}
            <a href="{{ route('concrete-pools-page') }}" class="aquarius-homepage-pool-card group/card" data-animate data-delay="100" title="{{ __('strings.pools_concrete_link_title') }}">
                <div class="pool-card-body">
                    <h3 class="pool-card-title">{{ __('strings.pools_concrete') }}</h3>
                    <p class="pool-card-desc">{!! __('strings.pools_concrete_desc') !!}</p>
                    <span class="pool-card-btn">
                        {{ __('strings.pools_concrete_link') }}
                        <svg class="pool-card-btn-arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </span>
                </div>
                <div class="pool-card-image">
                    <img loading="lazy" class="pool-card-img-default" src="{{ asset('assets/images/concrete-pools-homepage-1.jpg') }}" alt="Concrete Pool">
                    <img loading="lazy" class="pool-card-img-hover" src="{{ asset('assets/images/concrete-pools-homepage-2.jpg') }}" alt="Concrete Pool">
                </div>
            </a>

            {{-- Vinyl --}}
            <a href="{{ route('vinyl-pools-page') }}" class="aquarius-homepage-pool-card group/card" data-animate data-delay="200" title="{{ __('strings.pools_vinyl_link_title') }}">
                <div class="pool-card-body">
                    <h3 class="pool-card-title">{{ __('strings.pools_vinyl') }}</h3>
                    <p class="pool-card-desc">{!! __('strings.pools_vinyl_desc') !!}</p>
                    <span class="pool-card-btn">
                        {{ __('strings.pools_vinyl_link') }}
                        <svg class="pool-card-btn-arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </span>
                </div>
                <div class="pool-card-image">
                    <img loading="lazy" class="pool-card-img-default" src="{{ asset('assets/images/vinyl-pool-homepage-1.jpg') }}" alt="Vinyl Pool">
                    <img loading="lazy" class="pool-card-img-hover" src="{{ asset('assets/images/vinyl-pool-homepage-2.jpg') }}" alt="Vinyl Pool">
                </div>
            </a>

            {{-- Fibreglass --}}
            <a href="{{ route('fibreglass-pools-page') }}" class="aquarius-homepage-pool-card group/card" data-animate data-delay="300" title="{{ __('strings.pools_fibreglass_link_title') }}">
                <div class="pool-card-body">
                    <h3 class="pool-card-title">{{ __('strings.pools_fibreglass') }}</h3>
                    <p class="pool-card-desc">{!! __('strings.pools_fibreglass_desc') !!}</p>
                    <span class="pool-card-btn">
                        {{ __('strings.pools_fibreglass_link') }}
                        <svg class="pool-card-btn-arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </span>
                </div>
                <div class="pool-card-image">
                    <img loading="lazy" class="pool-card-img-default" src="{{ asset('assets/images/fibreglass-pools-homepage-1.jpg') }}" alt="Fibreglass Pool">
                    <img loading="lazy" class="pool-card-img-hover" src="{{ asset('assets/images/fibreglass-pools-homepage-2.jpg') }}" alt="Fibreglass Pool">
                </div>
            </a>

        </div>
    </div>
</section>