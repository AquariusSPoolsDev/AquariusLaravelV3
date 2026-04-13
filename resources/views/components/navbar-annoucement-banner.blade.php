@php
use App\Models\Promotion;
use Carbon\Carbon;

$currentDateTime = Carbon::now('Asia/Kuala_Lumpur');

// Fetch only ongoing promotions
$promotion = Promotion::where('start_time', '<=', $currentDateTime)
                        ->where('end_time', '>=', $currentDateTime)
                        ->orderBy('start_time')
                        ->first();
@endphp

<div class="container mt-4 mx-auto px-4">
    @if(session('promotion_dismissed') !== true && $promotion) <!-- Check if the promotion has not been dismissed -->
        <div id="promotion-banner" class="hs-removing:-translate-y-full bg-primary-600 rounded-xl shadow-sm hover:shadow-lg transition-all">
            <div class="p-2 lg:px-4">
                <div class="flex items-center">
                    <p class="text-white text-sm">
                        <strong>{{__('strings.alert_current_promo')}}:</strong> {{ $promotion->title }}&nbsp;&nbsp;<!-- Display the promotion title -->
                        <a class="underline font-medium hover:no-underline transition-all" href="{{ route('promo-page') }}">{{__('strings.Lebih Lanjut')}}</a>
                    </p>

                    <div class="ps-3 ms-auto">
                        <button type="button"
                            id="dismiss-promotion"
                            class="inline-flex rounded-lg p-1.5 text-white/80 hover:bg-white/10 focus:outline-none focus:bg-white/10"
                            data-hs-remove-element="#promotion-banner">
                            <span class="sr-only">{{__('strings.alert_dismiss')}}</span>
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
document.getElementById('dismiss-promotion').addEventListener('click', function() {
    // Hide the banner visually
    document.getElementById('promotion-banner').style.display = 'none';

    // Send AJAX request to store session variable for dismissal
    fetch("{{ route('dismiss-promotion') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ dismissed: true })
    });
});
</script>
