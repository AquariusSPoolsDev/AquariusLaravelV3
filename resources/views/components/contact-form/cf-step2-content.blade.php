<div class="">
    <h3 class="text-2xl font-semibold text-gray-950">{{__('strings.cf_step_2_title')}}</h3>
    <p class="mb-5 text-gray-950">{{__('strings.cf_step_2_desc')}}</p>

    <div class="mb-4">
        <label for="pool-interests" class="block mb-2 text-sm font-semibold text-primary-900">{{ __('strings.cf_step_2_interest_label') }}</label>
        <select id="pool-interests" name="cust_pool_interests"
            class="block w-full p-2.5 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
            <option value="">{{ __('strings.cf_step_2_select_an_option') }}</option>
            <option value="All Types of Pools">{{ __('strings.cf_step_2_input_alltypespools') }}</option>
            <option value="Tiled Concrete Pools">{{ __('strings.cf_step_2_input_tiledconcrete') }}</option>
            <option value="Fibreglass Pools">{{ __('strings.cf_step_2_input_fibreglasspools') }}</option>
            <option value="Steel Structure Vinyl Pools">{{ __('strings.cf_step_2_input_steelstructure') }}</option>
            <option value="Pool Repair">{{ __('strings.cf_step_2_input_poolrepair') }}</option>
            <option value="Pool Retiling">{{ __('strings.cf_step_2_input_poolretiling') }}</option>
            <option value="Pool Maintenance">{{ __('strings.cf_step_2_input_poolmaintenance') }}</option>
            <option value="Pool Equipment Supply">{{ __('strings.cf_step_2_input_poolequipment') }}</option>
            <option value="Others (Please Specify)">{{__('strings.cf_step_2_input_others')}} ({{__('strings.cf_step_2_input_others_specify')}})</option>
        </select>

        @error('cust_pool_interests')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="textarea-label" class="block mb-2 text-sm font-semibold text-primary-900">{{__('strings.cf_step_2_your_question')}}</label>
        <textarea id="textarea-label" name="cust_query" class="bg-gray-100 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 disabled:opacity-50 disabled:pointer-events-none" rows="3" placeholder="Include a question here"></textarea>

        @error('cust_query')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- <div class="grid grid-cols-1 lg:grid-cols-2">
        <div>
            <div class="flex items-center mb-4">
                <input
                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2"
                    type="checkbox" name="" id="alltypespools" value="All Types of Pools">
                <label class="ms-2 text-sm font-medium text-gray-700" for="alltypespools">{{__('strings.cf_step_2_input_alltypespools')}}</label>
            </div>
            <div class="flex items-center mb-4">
                <input
                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2"
                    type="checkbox" name="" id="tiledconcrete" value="Tiled Concrete Pools">
                <label class="ms-2 text-sm font-medium text-gray-700" for="tiledconcrete">{{__('strings.cf_step_2_input_tiledconcrete')}}</label>
            </div>
            <div class="flex items-center mb-4">
                <input
                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2"
                    type="checkbox" name="" id="fibreglasspools" value="Fibreglass Pools">
                <label class="ms-2 text-sm font-medium text-gray-700" for="fibreglasspools">{{__('strings.cf_step_2_input_fibreglasspools')}}</label>
            </div>
            <div class="flex items-center mb-4">
                <input
                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2"
                    type="checkbox" name="" id="steelstructure"
                    value="Steel Structure Vinyl Pools">
                <label class="ms-2 text-sm font-medium text-gray-700" for="steelstructure">{{__('strings.cf_step_2_input_steelstructure')}}</label>
            </div>
        </div>

        <div>
            <div class="flex items-center mb-4">
                <input
                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2"
                    type="checkbox" name="" id="poolrepair" value="Pool Repair">
                <label class="ms-2 text-sm font-medium text-gray-700" for="poolrepair">{{__('strings.cf_step_2_input_poolrepair')}}</label>
            </div>
            <div class="flex items-center mb-4">
                <input
                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2"
                    type="checkbox" name="" id="poolretiling" value="Pool Retiling">
                <label class="ms-2 text-sm font-medium text-gray-700" for="poolretiling">{{__('strings.cf_step_2_input_poolretiling')}}</label>
            </div>
            <div class="flex items-center mb-4">
                <input
                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2"
                    type="checkbox" name="" id="poolmaintenance" value="Pool Maintenance">
                <label class="ms-2 text-sm font-medium text-gray-700" for="poolmaintenance">{{__('strings.cf_step_2_input_poolmaintenance')}}</label>
            </div>
            <div class="flex items-center mb-4">
                <input
                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2"
                    type="checkbox" name="" id="poolequipment" value="Pool Equipment Supply">
                <label class="ms-2 text-sm font-medium text-gray-700" for="poolequipment">{{__('strings.cf_step_2_input_poolequipment')}}</label>
            </div>
        </div>
    </div>
    <div x-data="{ othersChecked: false }">
        <div class="flex items-center mb-2.5">
            <input
                class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2"
                type="checkbox" name="othersCheckbox" value="__other_option__" id="othersCheckbox"
                @change ="othersChecked = $event.target.checked">
            <label class="ms-2 text-sm font-medium text-gray-700" for="othersCheckbox">{{__('strings.cf_step_2_input_others')}}</label>
        </div>

        <div class="relative z-0 w-full mb-5 group" x-show="othersChecked" x-cloak>
            <input type="text" name="othersDescription" id="othersDescription"
                class="block py-2.5 px-0 w-full text-sm text-gray-950 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                placeholder=" " />
            <label for="othersDescription"
                class="peer-focus:font-medium absolute text-sm text-gray-700 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                {{__('strings.cf_step_2_input_others_specify')}}
            </label>
        </div>
    </div> --}}
</div>