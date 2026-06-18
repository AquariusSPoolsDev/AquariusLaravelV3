<div class="block lg:hidden my-0!">
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
        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title class=\" hs-selected:font-bold \"></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-primary-600 \" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"currentColor\"><path d=\"M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z\"></path></svg></span></div>",
        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 \" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"currentColor\"><path d=\"M200,136a8,8,0,0,1-8,8H64a8,8,0,0,1,0-16H192A8,8,0,0,1,200,136Zm32-56H24a8,8,0,0,0,0,16H232a8,8,0,0,0,0-16Zm-80,96H104a8,8,0,0,0,0,16h48a8,8,0,0,0,0-16Z\"></path></svg></div>"
    }' class="hidden mt-1">
        <option value="">{{__('strings.choose_dropdown')}}</option>
        @foreach($tags as $tag)
        <option value="{{ $tag }}">{{ $translatedTags[$tag] ?? $tag }}</option>
        @endforeach
    </select>
</div>