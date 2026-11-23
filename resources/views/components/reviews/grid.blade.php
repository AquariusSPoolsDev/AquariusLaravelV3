@forelse($reviews as $review)
<div class="aquarius-homepage-review-card" @if(!empty($animate)) data-animate data-delay="{{ 200 + $loop->index * 100 }}" @endif>

    {{-- Header: avatar + name + stars --}}
    <div class="review-card-header">
        <div class="review-card-avatar">
            {{ mb_substr($review->reviewer_name, 0, 1) }}
        </div>
        <div class="review-card-meta">
            <div class="review-card-meta-top">
                <h2 class="review-card-name">{{ $review->reviewer_name }}</h2>
                <div class="review-card-stars" role="img" aria-label="{{ __('strings.reviews_rating_label', ['rating' => $review->rating]) }}">
                    {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                </div>
            </div>
            <div class="review-card-source-row">
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
    <div class="review-card-body rich-text">
        {!! str($review->review)->sanitizeHtml() !!}
    </div>
</div>
@empty
<div class="col-span-full rounded-lg border border-neutral-200 bg-neutral-50 p-6 lg:p-8 text-center">
    <h2 class="text-2xl text-primary-900 font-semibold mb-3 mt-0">{{__('strings.reviews_no_review_title')}}</h2>
    <p class="text-neutral-700 m-0">{{__('strings.reviews_no_review_body')}}</p>
</div>
@endforelse
