<div class="">
    <h3 class="text-2xl font-semibold text-gray-950">{{__('strings.cf_step_2_title')}}</h3>
    <p class="mb-5 text-gray-950">{{__('strings.cf_step_2_desc')}}</p>

    <div class="mb-4">
        <label for="pool-interests" class="block mb-2 text-sm font-semibold text-primary-900">{{ __('strings.cf_step_2_interest_label') }}</label>
        <select id="pool-interests" name="cust_pool_interests" class="form-input">
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
        <textarea id="textarea-label" name="cust_query" class="form-input" rows="3" placeholder="Include a question here"></textarea>

        @error('cust_query')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
