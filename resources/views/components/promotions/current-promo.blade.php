{{-- QUERY --}}
@php
    use Carbon\Carbon;
    use App\Models\Promotion;

    // Get the current date and time in Asia/Kuala_Lumpur timezone
    $currentDateTime = Carbon::now('Asia/Kuala_Lumpur');

    // Fetch only the ongoing promotions
    $promotions = Promotion::where('start_time', '<=', $currentDateTime)
                            ->where('end_time', '>=', $currentDateTime)
                            ->orderBy('start_time')
                            ->get();
@endphp

@if($promotions->isNotEmpty())
    @foreach($promotions as $promotion)
    <div class="bg-secondary-50 border-s-4 border-secondary-500 rounded-e-xl p-6 ps-8 shadow-sm hover:shadow-lg transition-all" role="alert" tabindex="-1" aria-labelledby="promo_{{ $promotion->id }}">
        <div class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-lg text-xs font-medium bg-secondary-100 text-secondary-800">{{__('strings.promotions_current_promo_badge')}}</div>
        <h2 id="promo_{{ $promotion->id }}" class="text-gray-800 font-semibold my-2">{{ $promotion->title }}</h2>
        <p class="text-gray-700 m-0 my-2">{{ $promotion->description }}</p>
        <p class="text-gray-600 m-0 my-2 text-sm">
            <strong class="text-gray-700">{{__('strings.promotions_current_promo_duration')}}: </strong>{{ $promotion->start_time->timezone('Asia/Kuala_Lumpur')->format('j F Y, g:i A') }} - {{ $promotion->end_time->timezone('Asia/Kuala_Lumpur')->format('j F Y, g:i A') }}
        </p>

        <div class="">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                @foreach($promotion->file_attachment as $file)
                    @php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                        <div class="m-0 overflow-hidden rounded-xl shadow-sm hover:shadow-lg">
                            @php
                                $encodedFile = implode('/', array_map('rawurlencode', explode('/', 'promotion_materials/' . $file)));
                            @endphp
                            <a data-fslightbox="promotion_{{$promotion->id}}" href="{{ asset('storage/' . $encodedFile) }}">
                                <img src="{{ asset('storage/' . $encodedFile) }}" title="{{ $promotion->title }} Image Promotion" alt="{{ $promotion->title }} Image Promotion" class="m-0 w-full h-auto object-cover hover:scale-125 transition-all">
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
@else
    <div class="bg-red-50 border-s-4 border-red-500 rounded-e-xl p-6 ps-8" role="alert" tabindex="-1" aria-labelledby="nopromo">
        <h2 id="nopromo" class="text-gray-800 font-semibold mb-3 mt-0">{{__('strings.promotions_no_active_promo_title')}}</h2>
        <p class="text-gray-700 m-0">{{__('strings.promotions_no_active_promo_body')}}</p>
    </div>
@endif