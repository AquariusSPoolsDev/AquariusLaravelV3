<div class="">
    <h3 class="text-2xl font-semibold text-primary-900">{{__('strings.cf_step_1_title')}}</h3>
    <p class="mb-5 text-primary-900">{{__('strings.cf_step_1_desc')}}</p>

    <div class="mb-5">
        <label for="name" class="block mb-2 text-sm font-semibold text-primary-900">{{__('strings.cf_step_1_name_input')}}</label>
        <input type="text" id="name" name="cust_name" value="{{ old('cust_name') }}"
            class="bg-gray-100 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-primary focus:border-primary-500 block w-full p-2.5"
            placeholder="Ali bin Abu" required />

        @error('cust_name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-5">
        <label for="email" class="block mb-2 text-sm font-semibold text-primary-900">{{__('strings.cf_step_1_email_input')}}</label>
        <input type="email" id="email" name="cust_email" value="{{ old('cust_email') }}"
            class="bg-gray-100 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
            placeholder="aliabu@test.com" required />
        
        @error('cust_email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-5">
        <label for="phone" class="block mb-2 text-sm font-semibold text-primary-900">{{__('strings.cf_step_1_phone_input')}}</label>
        <input type="tel" id="phone" name="cust_phone" value="{{ old('cust_phone') }}"
            class="bg-gray-100 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
            placeholder="012-43567890" required />
        
        @error('cust_phone')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
        </div>
</div>