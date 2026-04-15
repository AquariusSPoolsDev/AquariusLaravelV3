<div class="">
    <h3 class="text-2xl font-semibold text-gray-950">{{__('strings.cf_step_3_title')}}</h3>
    <p class="mb-5 text-gray-950">{{__('strings.cf_step_3_desc')}}</p>

    <div class="input-date mb-5">
        <label for="date" class="block mb-2 text-sm font-semibold text-gray-950">{{__('strings.cf_step_3_select_date')}}</label>
        <input type="date" id="date" name="cust_callback_date" class="form-input"
                placeholder="Select date">

        @error('cust_callback_date')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="input-time mb-5">
        <label for="time" class="block mb-2 text-sm font-semibold text-gray-950">{{__('strings.cf_step_3_select_time')}}</label>
        <div class="relative">
            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                <svg class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <input type="time" id="time" name="cust_callback_time"
                class="form-input"
                value="09:00" required />
        </div>

        @error('cust_callback_time')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center">
        <input id="link-checkbox" type="checkbox" name="cust_agree" value="1"
            class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 focus:ring-2 "
            required>
        <label for="link-checkbox" class="ms-2 text-sm font-medium text-gray-950">{{__('strings.cf_step_3_agree_1')}}<a href="/privacy" class="text-primary-600 underline hover:no-underline font-semibold">{{__('strings.cf_step_3_privacy_link')}}</a>{{__('strings.cf_step_3_agree_2')}}</label>

        @error('cust_agree')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
