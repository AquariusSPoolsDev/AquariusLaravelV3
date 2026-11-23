<form id="aquarius_contact_form" action="{{ route('send-email-page') }}" method="post" novalidate
    x-data="{ submitting: false }"
    @submit="submitting = true">
    @csrf

    {{-- Honeypot — hidden from humans, bots fill this --}}
    <div style="display:none" aria-hidden="true">
        <input type="text" name="website" tabindex="-1" autocomplete="off">
    </div>

    {{-- Submitting overlay --}}
    <div x-show="submitting" x-cloak class="flex flex-col items-center justify-center gap-3 py-10 text-center">
        <svg class="animate-spin size-10 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-100" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <p class="text-neutral-900 font-semibold">{{ __('strings.cf_step_4_body_main') }}</p>
    </div>

    <div x-show="!submitting">
        @if ($errors->any())
            <x-reusables.alert color="error" class="mb-5 text-base">
                {{ __('strings.cf_error_summary') }}
            </x-reusables.alert>
        @endif

        {{-- Name --}}
        <div class="mb-5">
            <label for="cust_name" class="font-semibold text-neutral-900 block mb-1.5 text-base">
                {{ __('strings.cf_step_1_name_input') }} <span class="text-error-300" aria-hidden="true">*</span>
            </label>
            <input type="text" id="cust_name" name="cust_name" value="{{ old('cust_name') }}"
                autocomplete="name" @error('cust_name') aria-invalid="true" aria-describedby="cust_name-error" @enderror
                class="form-input @error('cust_name') border-error-300 @enderror"
                placeholder="Ali bin Abu" required />
            @error('cust_name')
                <p id="cust_name-error" class="text-error-300 text-base mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-5">
            <label for="cust_email" class="font-semibold text-neutral-900 block mb-1.5 text-base">
                {{ __('strings.cf_step_1_email_input') }} <span class="text-error-300" aria-hidden="true">*</span>
            </label>
            <input type="email" id="cust_email" name="cust_email" value="{{ old('cust_email') }}"
                autocomplete="email" autocapitalize="none" spellcheck="false" @error('cust_email') aria-invalid="true" aria-describedby="cust_email-error" @enderror
                class="form-input @error('cust_email') border-error-300 @enderror"
                placeholder="aliabu@example.com" required />
            @error('cust_email')
                <p id="cust_email-error" class="text-error-300 text-base mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Phone with country code --}}
        <div class="mb-5">
            <label for="cust_phone" class="font-semibold text-neutral-900 block mb-1.5 text-base">
                {{ __('strings.cf_step_1_phone_input') }} <span class="text-error-300" aria-hidden="true">*</span>
            </label>
            <div class="flex flex-wrap gap-2">
                <select name="country_code" id="country_code" aria-label="{{ __('strings.cf_country_code_label') }}"
                    autocomplete="tel-country-code" @error('country_code') aria-invalid="true" aria-describedby="country_code-error" @enderror
                    class="form-input w-32! shrink-0 @error('country_code') border-error-300 @enderror">
                    <option value="+60" {{ old('country_code', '+60') === '+60' ? 'selected' : '' }}>🇲🇾 +60</option>
                    <option value="+65" {{ old('country_code') === '+65' ? 'selected' : '' }}>🇸🇬 +65</option>
                    <option value="other" {{ old('country_code') === 'other' ? 'selected' : '' }}>{{ __('strings.cf_country_others') }}</option>
                </select>
                <input type="tel" id="cust_phone" name="cust_phone" value="{{ old('cust_phone') }}"
                    autocomplete="tel-national" @error('cust_phone') aria-invalid="true" aria-describedby="cust_phone-error" @enderror
                    class="form-input min-w-0 flex-1 basis-36 @error('cust_phone') border-error-300 @enderror"
                    placeholder="12-3456789"
                    inputmode="numeric"
                    pattern="[0-9\-\s]+"
                    @keydown="if(!/[0-9\-\s]/.test($event.key) && !['Backspace','Delete','Tab','ArrowLeft','ArrowRight'].includes($event.key)) $event.preventDefault()"
                    required />
            </div>
            @error('cust_phone')
                <p id="cust_phone-error" class="text-error-300 text-base mt-1">{{ $message }}</p>
            @enderror
            @error('country_code')
                <p id="country_code-error" class="text-error-300 text-base mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Interest --}}
        <div class="mb-5" x-data="{ interest: '{{ old('cust_pool_interests', request('interest', '')) }}' }">
            <label for="cust_pool_interests" class="font-semibold text-neutral-900 block mb-1.5 text-base">
                {{ __('strings.cf_step_2_interest_label') }} <span class="text-error-300" aria-hidden="true">*</span>
            </label>
            <select id="cust_pool_interests" name="cust_pool_interests" @error('cust_pool_interests') aria-invalid="true" aria-describedby="cust_pool_interests-error" @enderror
                class="form-input @error('cust_pool_interests') border-error-300 @enderror"
                x-model="interest" required>
                <option value="">{{ __('strings.cf_step_2_select_an_option') }}</option>
                <option value="Free Pool Assessment">{{ __('strings.cf_step_2_input_freeassessment') }}</option>
                <option value="All Types of Pools">{{ __('strings.cf_step_2_input_alltypespools') }}</option>
                <option value="Tiled Concrete Pools">{{ __('strings.cf_step_2_input_tiledconcrete') }}</option>
                <option value="Fibreglass Pools">{{ __('strings.cf_step_2_input_fibreglasspools') }}</option>
                <option value="Steel Structure Vinyl Pools">{{ __('strings.cf_step_2_input_steelstructure') }}</option>
                <option value="Pool Repair">{{ __('strings.cf_step_2_input_poolrepair') }}</option>
                <option value="Pool Retiling">{{ __('strings.cf_step_2_input_poolretiling') }}</option>
                <option value="Pool Maintenance">{{ __('strings.cf_step_2_input_poolmaintenance') }}</option>
                <option value="Pool Equipment Supply">{{ __('strings.cf_step_2_input_poolequipment') }}</option>
                <option value="Others (Please Specify)">{{ __('strings.cf_step_2_input_others') }} ({{ __('strings.cf_step_2_input_others_specify') }})</option>
            </select>
            @error('cust_pool_interests')
                <p id="cust_pool_interests-error" class="text-error-300 text-base mt-1">{{ $message }}</p>
            @enderror

            {{-- Others specify — show only when "Others" selected --}}
            <div x-show="interest === 'Others (Please Specify)'" x-cloak class="mt-3">
                <label for="cust_interest_other" class="font-semibold text-neutral-900 block mb-1.5 text-base">
                    {{ __('strings.cf_step_2_input_others_specify') }}
                </label>
                <input type="text" id="cust_interest_other" name="cust_interest_other" @error('cust_interest_other') aria-invalid="true" aria-describedby="cust_interest_other-error" @enderror
                    value="{{ old('cust_interest_other') }}"
                    class="form-input @error('cust_interest_other') border-error-300 @enderror"
                    placeholder="{{ __('strings.cf_others_placeholder') }}" />
                @error('cust_interest_other')
                    <p id="cust_interest_other-error" class="text-error-300 text-base mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Query --}}
        <div class="mb-5">
            <label for="cust_query" class="font-semibold text-neutral-900 block mb-1.5 text-base">
                {{ __('strings.cf_step_2_your_question') }}
            </label>
            <textarea id="cust_query" name="cust_query" @error('cust_query') aria-invalid="true" aria-describedby="cust_query-error" @enderror
                class="form-input @error('cust_query') border-error-300 @enderror"
                rows="4"
                placeholder="{{ __('strings.cf_query_placeholder') }}">{{ old('cust_query') }}</textarea>
            @error('cust_query')
                <p id="cust_query-error" class="text-error-300 text-base mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Agreement --}}
        <div class="mb-6">
            <label class="flex items-start gap-3 cursor-pointer">
                <input type="checkbox" id="cust_agree" name="cust_agree" value="1" @error('cust_agree') aria-invalid="true" aria-describedby="cust_agree-error" @enderror
                    class="mt-0.5 w-4 h-4 shrink-0 appearance-auto rounded accent-primary-600 cursor-pointer {{ $errors->has('cust_agree') ? 'border-error-300' : 'border-neutral-400' }}"
                    {{ old('cust_agree') ? 'checked' : '' }} required>
                <span class="text-base text-neutral-700">
                    {{ __('strings.cf_step_3_agree_1') }}<a href="{{ route('privacy-page') }}" class="text-primary-600 underline hover:no-underline active:no-underline font-semibold">{{ __('strings.cf_step_3_privacy_link') }}</a>{{ __('strings.cf_step_3_agree_2') }}
                </span>
            </label>
            @error('cust_agree')
                <p id="cust_agree-error" class="text-error-300 text-base mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit — disabled while submitting to prevent double-submission before overlay paints --}}
        <button type="submit"
            :disabled="submitting"
            class="w-full text-center py-2.5 px-5.5 font-bold rounded-lg transition-all cursor-pointer text-white bg-primary hover:bg-primary-600 active:bg-primary-700 active:scale-95 focus:bg-primary-600 disabled:opacity-50 disabled:pointer-events-none">
            {{ __('strings.cf_btn_submit') }}
        </button>
    </div>
</form>
