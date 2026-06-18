<div id="loading-indicator" style="display:none;" class="mb-4">
    <div class="relative">
        <x-reusables.alert color="info">
            <div class="flex gap-x-2 lg:gap-x-4 items-center">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256" fill="currentColor"><path d="M236.8,188.09,149.35,36.22h0a24.76,24.76,0,0,0-42.7,0L19.2,188.09a23.51,23.51,0,0,0,0,23.72A24.35,24.35,0,0,0,40.55,224h174.9a24.35,24.35,0,0,0,21.33-12.19A23.51,23.51,0,0,0,236.8,188.09ZM222.93,203.8a8.5,8.5,0,0,1-7.48,4.2H40.55a8.5,8.5,0,0,1-7.48-4.2,7.59,7.59,0,0,1,0-7.72L120.52,44.21a8.75,8.75,0,0,1,15,0l87.45,151.87A7.59,7.59,0,0,1,222.93,203.8ZM120,144V104a8,8,0,0,1,16,0v40a8,8,0,0,1-16,0Zm20,36a12,12,0,1,1-12-12A12,12,0,0,1,140,180Z"></path></svg>
                </div>
                <div class="grow">
                    <h3 class="text-lg lg:text-xl font-medium">
                        {{__('strings.showcase_search_loading')}}
                    </h3>
                    <div class="text-sm lg:text-base mt-2">
                        {{__('strings.showcase_search_loading_desc')}}
                    </div>
                </div>
            </div>
        </x-reusables.alert>

        <div class="absolute top-0 inset-s-0 size-full bg-white/50"></div>

        <div class="absolute top-1/2 inset-s-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-primary-600 rounded-full"
                role="status" aria-label="loading">
                <span class="sr-only">{{__('strings.showcase_search_loading')}}</span>
            </div>
        </div>
    </div>
</div>