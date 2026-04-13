<div class="hidden lg:flex lg:items-center mb-0">
    <div class="grid grid-cols-2 lg:grid-cols-7 lg:gap-2 w-full ">
        @foreach($tags as $tag)
        <label class="inline-flex items-center justify-center w-full text-center hover:bg-primary-50 
                      rounded-xl px-4 py-2 cursor-pointer 
                      border border-gray-200 
                      transition-colors duration-200
                      has-[:checked]:bg-primary-600 has-[:checked]:border-primary-700 text-sm has-[:checked]:text-white has-[:checked]:font-semibold">
            <input type="checkbox" name="tags[]" value="{{ $tag }}" 
                   class="tag-checkbox hidden">
            {{ $translatedTags[$tag] ?? $tag }}
        </label>
        @endforeach
    </div>
</div>