@php
    $fieldMessages = [
        'cust_name' => ['required' => __('strings.cf_err_name_required')],
        'cust_email' => ['required' => __('strings.cf_err_email_required'), 'invalid' => __('strings.cf_err_email_invalid')],
        'cust_phone' => ['required' => __('strings.cf_err_phone_required'), 'invalid' => __('strings.cf_err_phone_invalid')],
        'cust_pool_interests' => ['required' => __('strings.cf_err_interest_required')],
        'cust_interest_other' => ['required' => __('strings.cf_err_other_required')],
        'cust_agree' => ['required' => __('strings.cf_err_agree_required')],
    ];
@endphp

{{-- The browser checks the fields first (resources/js/contact-form.js), so an empty or wrong submit shows
     the problems in place without reloading. The server checks again; its errors are rendered here too,
     so the form still works without JavaScript. --}}
<form id="aquarius_contact_form" action="{{ route('send-email-page') }}" method="post" novalidate
    x-data="contactForm({ messages: {{ Js::from($fieldMessages) }}, serverErrors: {{ Js::from($errors->getMessages()) }} })"
    @submit="submit($event)"
    @focusout="onBlur($event)"
    @input="onInput($event)"
    @change="onChange($event)"
    @pageshow.window="if ($event.persisted) submitting = false">
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
        {{-- Name --}}
        <div class="mb-5">
            <label for="cust_name" class="font-semibold text-neutral-900 block mb-1.5 text-base">
                {{ __('strings.cf_step_1_name_input') }} <span class="text-error-300" aria-hidden="true">*</span>
            </label>
            <input type="text" id="cust_name" name="cust_name" value="{{ old('cust_name') }}"
                autocomplete="name" maxlength="80" @error('cust_name') aria-invalid="true" aria-describedby="cust_name-error" @enderror
                x-bind:aria-invalid="hasError('cust_name') ? 'true' : null"
                x-bind:aria-describedby="hasError('cust_name') ? 'cust_name-error' : null"
                class="form-input"
                placeholder="Ali bin Abu" required />
            <p id="cust_name-error" class="text-error-300 text-base mt-1" x-bind:hidden="!hasError('cust_name')" x-text="errors.cust_name" @unless ($errors->has('cust_name')) hidden @endunless>{{ $errors->first('cust_name') }}</p>
        </div>

        {{-- Email --}}
        <div class="mb-5">
            <label for="cust_email" class="font-semibold text-neutral-900 block mb-1.5 text-base">
                {{ __('strings.cf_step_1_email_input') }} <span class="text-error-300" aria-hidden="true">*</span>
            </label>
            <input type="email" id="cust_email" name="cust_email" value="{{ old('cust_email') }}"
                autocomplete="email" autocapitalize="none" spellcheck="false" maxlength="80" @error('cust_email') aria-invalid="true" aria-describedby="cust_email-error" @enderror
                x-bind:aria-invalid="hasError('cust_email') ? 'true' : null"
                x-bind:aria-describedby="hasError('cust_email') ? 'cust_email-error' : null"
                class="form-input"
                placeholder="aliabu@example.com" required />
            <p id="cust_email-error" class="text-error-300 text-base mt-1" x-bind:hidden="!hasError('cust_email')" x-text="errors.cust_email" @unless ($errors->has('cust_email')) hidden @endunless>{{ $errors->first('cust_email') }}</p>
        </div>

        {{-- Phone with country code --}}
        <div class="mb-5">
            <label for="cust_phone" class="font-semibold text-neutral-900 block mb-1.5 text-base">
                {{ __('strings.cf_step_1_phone_input') }} <span class="text-error-300" aria-hidden="true">*</span>
            </label>
            <div class="flex flex-wrap gap-2">
                <select name="country_code" id="country_code" aria-label="{{ __('strings.cf_country_code_label') }}"
                    autocomplete="tel-country-code" @error('country_code') aria-invalid="true" aria-describedby="country_code-error" @enderror
                    class="form-input w-32! shrink-0">
                    <option value="+60" {{ old('country_code', '+60') === '+60' ? 'selected' : '' }}>🇲🇾 +60</option>
                    <option value="+65" {{ old('country_code') === '+65' ? 'selected' : '' }}>🇸🇬 +65</option>
                    <option value="other" {{ old('country_code') === 'other' ? 'selected' : '' }}>{{ __('strings.cf_country_others') }}</option>
                </select>
                {{-- Typing is limited to digits, spaces and dashes; shortcuts (paste, select all) and keys like Enter still work --}}
                <input type="tel" id="cust_phone" name="cust_phone" value="{{ old('cust_phone') }}"
                    autocomplete="tel-national" maxlength="20" @error('cust_phone') aria-invalid="true" aria-describedby="cust_phone-error" @enderror
                    x-bind:aria-invalid="hasError('cust_phone') ? 'true' : null"
                    x-bind:aria-describedby="hasError('cust_phone') ? 'cust_phone-error' : null"
                    class="form-input min-w-0 flex-1 basis-36"
                    placeholder="12-3456789"
                    inputmode="numeric"
                    pattern="[0-9\-\s]+"
                    @keydown="if ($event.key.length === 1 && !$event.ctrlKey && !$event.metaKey && !$event.altKey && !/[0-9\-\s]/.test($event.key)) $event.preventDefault()"
                    required />
            </div>
            <p id="cust_phone-error" class="text-error-300 text-base mt-1" x-bind:hidden="!hasError('cust_phone')" x-text="errors.cust_phone" @unless ($errors->has('cust_phone')) hidden @endunless>{{ $errors->first('cust_phone') }}</p>
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
                x-bind:aria-invalid="hasError('cust_pool_interests') ? 'true' : null"
                x-bind:aria-describedby="hasError('cust_pool_interests') ? 'cust_pool_interests-error' : null"
                class="form-input"
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
            <p id="cust_pool_interests-error" class="text-error-300 text-base mt-1" x-bind:hidden="!hasError('cust_pool_interests')" x-text="errors.cust_pool_interests" @unless ($errors->has('cust_pool_interests')) hidden @endunless>{{ $errors->first('cust_pool_interests') }}</p>

            {{-- Others specify: shown, and required, only when "Others" is selected --}}
            <div x-show="interest === 'Others (Please Specify)'" x-cloak class="mt-3">
                <label for="cust_interest_other" class="font-semibold text-neutral-900 block mb-1.5 text-base">
                    {{ __('strings.cf_step_2_input_others_specify') }} <span class="text-error-300" aria-hidden="true">*</span>
                </label>
                <input type="text" id="cust_interest_other" name="cust_interest_other" maxlength="120" @error('cust_interest_other') aria-invalid="true" aria-describedby="cust_interest_other-error" @enderror
                    x-bind:required="interest === 'Others (Please Specify)'"
                    x-bind:aria-invalid="hasError('cust_interest_other') ? 'true' : null"
                    x-bind:aria-describedby="hasError('cust_interest_other') ? 'cust_interest_other-error' : null"
                    x-effect="if (interest !== 'Others (Please Specify)') delete errors.cust_interest_other"
                    value="{{ old('cust_interest_other') }}"
                    class="form-input"
                    placeholder="{{ __('strings.cf_others_placeholder') }}" />
                <p id="cust_interest_other-error" class="text-error-300 text-base mt-1" x-bind:hidden="!hasError('cust_interest_other')" x-text="errors.cust_interest_other" @unless ($errors->has('cust_interest_other')) hidden @endunless>{{ $errors->first('cust_interest_other') }}</p>
            </div>
        </div>

        {{-- Query --}}
        <div class="mb-5">
            <label for="cust_query" class="font-semibold text-neutral-900 block mb-1.5 text-base">
                {{ __('strings.cf_step_2_your_question') }}
            </label>
            <textarea id="cust_query" name="cust_query" maxlength="1000" @error('cust_query') aria-invalid="true" aria-describedby="cust_query-error" @enderror
                class="form-input"
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
                    x-bind:aria-invalid="hasError('cust_agree') ? 'true' : null"
                    x-bind:aria-describedby="hasError('cust_agree') ? 'cust_agree-error' : null"
                    class="mt-0.5 w-4 h-4 shrink-0 appearance-auto rounded accent-primary-600 cursor-pointer border-neutral-400"
                    {{ old('cust_agree') ? 'checked' : '' }} required>
                <span class="text-base text-neutral-700">
                    {{ __('strings.cf_step_3_agree_1') }}<a href="{{ route('privacy-page') }}" class="text-primary-600 underline hover:no-underline active:no-underline font-semibold">{{ __('strings.cf_step_3_privacy_link') }}</a>{{ __('strings.cf_step_3_agree_2') }}
                </span>
            </label>
            <p id="cust_agree-error" class="text-error-300 text-base mt-1" x-bind:hidden="!hasError('cust_agree')" x-text="errors.cust_agree" @unless ($errors->has('cust_agree')) hidden @endunless>{{ $errors->first('cust_agree') }}</p>
        </div>

        {{-- Submit stays enabled so pressing it always shows what is missing; it is disabled only while sending --}}
        <button type="submit"
            :disabled="submitting"
            class="w-full text-center py-2.5 px-5.5 font-bold rounded-lg transition-all cursor-pointer text-white bg-primary hover:bg-primary-600 active:bg-primary-700 active:scale-95 focus:bg-primary-600 disabled:opacity-50 disabled:pointer-events-none">
            {{ __('strings.cf_btn_submit') }}
        </button>
    </div>
</form>
