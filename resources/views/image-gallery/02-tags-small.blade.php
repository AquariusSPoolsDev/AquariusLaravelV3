<div class="block lg:hidden !my-0">
    <select id="multiple-with-conditional-counter-select" multiple data-hs-select='{
        "placeholder": "{{__('strings.choose_dropdown')}}",
        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 ps-4 pe-10 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-primary",
        "toggleSeparators": {
          "betweenItemsAndCounter": "&"
        },
        "toggleCountText": "{{__('strings.select_more_dropdown')}}",
        "toggleCountTextMinItems": 3,
        "toggleCountTextMode": "nItemsAndCount",
        "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300",
        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 hover:text-primary-800 hover:font-bold focus:outline-none focus:bg-gray-100 focus:text-primary-800 focus:font-bold rounded-lg",
        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title class=\" hs-selected:font-bold \"></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-primary-600 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
    }' class="hidden mt-1">
        <option value="">{{__('strings.choose_dropdown')}}</option>
        @foreach($tags as $tag)
        <option value="{{ $tag }}">{{ $translatedTags[$tag] ?? $tag }}</option>
        @endforeach
    </select>
</div>