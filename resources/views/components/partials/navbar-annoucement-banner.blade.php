@php
use App\Models\Promotion;
use Carbon\Carbon;

$currentDateTime = Carbon::now('Asia/Kuala_Lumpur');

// Fetch only ongoing promotions
$promotion = Promotion::where('start_time', '<=', $currentDateTime) ->where('end_time', '>=', $currentDateTime)
    ->orderBy('start_time')
    ->first();
    @endphp

    @if(session('promotion_dismissed') !== true && $promotion)
    <div class="navbar-annoucement container mt-4 mx-auto px-4 md:px-6 lg:px-8"
        x-data="{ show: true }"
        x-show="show"
        x-transition:leave="transition duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-full">
        <div class="bg-primary-600 rounded-lg shadow-sm hover:shadow-lg hover:scale-101 active:scale-99 transition-all duration-200">
            <div class="py-2 px-4">
                <div class="flex items-center">
                    <p class="text-white text-sm">
                        <strong>{{__('strings.alert_current_promo')}}:</strong> {{ $promotion->title }}&nbsp;&nbsp;
                        <a class="underline font-medium hover:no-underline transition-all"
                            href="{{ route('promo-page') }}">{{__('strings.alert_learn_more')}}</a>
                    </p>

                    <div class="ps-3 ms-auto">
                        <button type="button"
                            class="inline-flex rounded-lg p-1.5 text-white/80 hover:bg-white/10 focus:outline-none focus:bg-white/10"
                            @click="show = false; fetch('{{ route('dismiss-promotion') }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content, 'Content-Type': 'application/json' }, body: JSON.stringify({ dismissed: true }) })">
                            <span class="sr-only">{{__('strings.alert_dismiss')}}</span>
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif