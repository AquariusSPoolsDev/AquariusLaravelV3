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
                    <img loading="lazy" class="pool-card-img-default" src="{{ asset('assets/images/concrete/concrete-pool-1.jpg') }}" alt="Aquarius Pools finished commercial concrete pool" title="Learn More about Concrete Pools">
                    <img loading="lazy" class="pool-card-img-hover" src="{{ asset('assets/images/concrete/concrete-pool-2.jpg') }}" alt="Aquarius Pools finished residential concrete pool" title="Learn More about Concrete Pools">
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
                    <img loading="lazy" class="pool-card-img-default" src="{{ asset('assets/images/vinyl/vinyl-pool-1.jpg') }}" alt="Aquarius Pools residential vinyl pool" title="Learn More about Vinyl Pools">
                    <img loading="lazy" class="pool-card-img-hover" src="{{ asset('assets/images/vinyl/vinyl-pool-2.jpg') }}" alt="Aquarius Pools finished vinyl pool" title="Learn More about Vinyl Pools">
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
                    <img loading="lazy" class="pool-card-img-default" src="{{ asset('assets/images/fibreglass/fibreglass-pool-1.jpg') }}" alt="Aquarius Pools fibreglass pool" title="Learn More about Fibreglass Pools">
                    <img loading="lazy" class="pool-card-img-hover" src="{{ asset('assets/images/fibreglass/fibreglass-pool-2.jpg') }}" alt="Aquarius Pools fibreglass pool" title="Learn More about Fibreglass Pools">
                </div>
            </a>

        </div>
    </div>
</section>