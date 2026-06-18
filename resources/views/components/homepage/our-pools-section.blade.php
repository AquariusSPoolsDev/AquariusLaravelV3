<section id="our-pools" class="bg-primary-50/50">
    <div class="main-container">
        <div class="max-w-2xl mx-auto text-center">
            <x-reusables.pill-text class="block" data-animate data-delay="0">{{__('strings.our_pools_overview_pill')}}</x-reusables.pill-text>
            <h2 class="aquarius-homepage-heading" data-animate data-delay="100">{{__('strings.pools_heading')}}</h2>
        </div>

        <div class="aquarius-homepage-card-grid">
            {{-- Concrete --}}
            <a href="{{ route('concrete-pools-page') }}" class="aquarius-homepage-pool-card group/card" data-animate data-delay="100" title="{{ __('strings.pools_concrete_link_title') }}">
                <div class="pool-card-body">
                    <h3 class="pool-card-title">{{ __('strings.pools_concrete') }}</h3>
                    <p class="pool-card-desc">{!! __('strings.pools_concrete_desc') !!}</p>
                    <span class="pool-card-btn">
                        {{ __('strings.pools_concrete_link') }}
                        <svg class="pool-card-btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
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
                        <svg class="pool-card-btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
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
                        <svg class="pool-card-btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
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
