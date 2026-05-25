<section id="our-pools" class="our-pools-container">
    <div class="main-container">
        <h2 class="aquarius-homepage-heading">{{__('strings.pools_heading')}}</h2>

        <div class="aquarius-card-grid">
            {{-- Concrete --}}
            <a href="{{ route('concrete-pools-page') }}" class="aquarius-card group" title="{{ __('strings.pools_concrete_link_title') }}">
                <div class="aquarius-card-body">
                    <h3 class="aquarius-card-title">{{ __('strings.pools_concrete') }}</h3>
                    <p class="aquarius-card-desc">{!! __('strings.pools_concrete_desc') !!}</p>
                    <span class="aquarius-card-btn">
                        {{ __('strings.pools_concrete_link') }}
                        <svg class="w-5 h-5 transition-transform duration-200 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </span>
                </div>
                <div class="aquarius-card-image">
                    <img loading="lazy" class="aquarius-card-img-default" src="{{ asset('assets/images/concrete-pools-homepage-1.jpg') }}" alt="Concrete Pool">
                    <img loading="lazy" class="aquarius-card-img-hover" src="{{ asset('assets/images/concrete-pools-homepage-2.jpg') }}" alt="Concrete Pool">
                </div>
            </a>

            {{-- Vinyl --}}
            <a href="{{ route('vinyl-pools-page') }}" class="aquarius-card group" title="{{ __('strings.pools_vinyl_link_title') }}">
                <div class="aquarius-card-body">
                    <h3 class="aquarius-card-title">{{ __('strings.pools_vinyl') }}</h3>
                    <p class="aquarius-card-desc">{!! __('strings.pools_vinyl_desc') !!}</p>
                    <span class="aquarius-card-btn">
                        {{ __('strings.pools_vinyl_link') }}
                        <svg class="w-5 h-5 transition-transform duration-200 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </span>
                </div>
                <div class="aquarius-card-image">
                    <img loading="lazy" class="aquarius-card-img-default" src="{{ asset('assets/images/vinyl-pool-homepage-1.jpg') }}" alt="Vinyl Pool">
                    <img loading="lazy" class="aquarius-card-img-hover" src="{{ asset('assets/images/vinyl-pool-homepage-2.jpg') }}" alt="Vinyl Pool">
                </div>
            </a>

            {{-- Fibreglass --}}
            <a href="{{ route('fibreglass-pools-page') }}" class="aquarius-card group" title="{{ __('strings.pools_fibreglass_link_title') }}">
                <div class="aquarius-card-body">
                    <h3 class="aquarius-card-title">{{ __('strings.pools_fibreglass') }}</h3>
                    <p class="aquarius-card-desc">{!! __('strings.pools_fibreglass_desc') !!}</p>
                    <span class="aquarius-card-btn">
                        {{ __('strings.pools_fibreglass_link') }}
                        <svg class="w-5 h-5 transition-transform duration-200 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </span>
                </div>
                <div class="aquarius-card-image">
                    <img loading="lazy" class="aquarius-card-img-default" src="{{ asset('assets/images/fibreglass-pools-homepage-1.jpg') }}" alt="Fibreglass Pool">
                    <img loading="lazy" class="aquarius-card-img-hover" src="{{ asset('assets/images/fibreglass-pools-homepage-2.jpg') }}" alt="Fibreglass Pool">
                </div>
            </a>

        </div>
    </div>
</section>