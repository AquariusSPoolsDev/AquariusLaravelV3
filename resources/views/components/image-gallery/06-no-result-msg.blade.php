<div id="no-results-message" hidden>
    <div class="mt-6 flex justify-center">
        <div class="bg-primary-50 border max-w-xl border-primary-100 text-primary-800 rounded-lg py-4 px-8">
            {{__('strings.showcase_search_no_result')}}
        </div>
    </div>
</div>

<div id="gallery-error-message" hidden>
    <div class="mt-6 flex justify-center">
        <div class="bg-error-100 border max-w-xl border-error-200 text-error-400 rounded-lg py-4 px-8">
            {{__('strings.showcase_search_error')}}
        </div>
    </div>
</div>

{{-- Screen readers hear the result of each search here; app.js fills it in. --}}
<p id="gallery-search-status" class="sr-only" aria-live="polite" aria-atomic="true"
    data-none="{{__('strings.showcase_search_no_result')}}"
    data-one="{{__('strings.showcase_search_found_one')}}"
    data-many="{{__('strings.showcase_search_found_many')}}"
    data-error="{{__('strings.showcase_search_error')}}"></p>
