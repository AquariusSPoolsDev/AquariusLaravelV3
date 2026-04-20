<div class="hidden lg:flex lg:items-center mb-0">
    <div class="grid grid-cols-2 lg:grid-cols-7 lg:gap-2 w-full ">
        @foreach($tags as $tag)
        <label class="gallery-tags-label">
            <input type="checkbox" name="tags[]" value="{{ $tag }}" 
                   class="tag-checkbox hidden">
            {{ $translatedTags[$tag] ?? $tag }}
        </label>
        @endforeach
    </div>
</div>