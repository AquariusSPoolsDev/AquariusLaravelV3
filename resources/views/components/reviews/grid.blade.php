@forelse($reviews as $review)
<div class="bg-white border border-neutral-200 rounded-lg p-4 lg:p-6 h-full break-before-avoid transition-all duration-300 hover:-translate-y-1 hover:border-primary-300 hover:shadow-lg hover:shadow-primary-100">

    {{-- Header: avatar + name + stars --}}
    <div class="flex items-center gap-3 mb-5">
        <div class="shrink-0 w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold uppercase">
            {{ mb_substr($review->reviewer_name, 0, 1) }}
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between gap-2">
                <h2 class="font-bold text-neutral-900 truncate">{{ $review->reviewer_name }}</h2>
                <div class="shrink-0 text-yellow-400 leading-none">
                    {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-1.5 text-sm text-neutral-600 mt-1">
                @if($review->source)
                    <span class="font-bold">{{ $review->source }}</span>
                @endif
                @if($review->source && $review->reviewed_at)
                    <span>·</span>
                @endif
                @if($review->reviewed_at)
                    <span>{{ $review->reviewed_at->format('d M Y') }}</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Review text --}}
    <div class="rich-text italic text-neutral-700 pt-4 mt-4 border-t border-neutral-200">
        {!! $review->review !!}
    </div>
</div>
@empty
<div class="col-span-full bg-red-50 border-s-4 border-red-500 rounded-e-xl p-6 ps-8" role="alert">
    <h2 class="text-2xl text-neutral-900 font-semibold mb-3 mt-0">{{__('strings.reviews_no_review_title')}}</h2>
    <p class="text-neutral-700 m-0">{{__('strings.reviews_no_review_body')}}</p>
</div>
@endforelse
