<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    public function showActivePromotions()
    {
        // Get the current date and time in Asia/Kuala Lumpur timezone
        // $currentDateTime = Carbon::now('Asia/Kuala_Lumpur');

        // Fetch only ongoing promotions
        // $promotion = Promotion::where('start_time', '<=', $currentDateTime)
        //                         ->where('end_time', '>=', $currentDateTime)
        //                         ->orderBy('start_time')
        //                         ->first(); // Get the first active promotion

        // Pass the promotion to the view
        return view('navbar-annoucement-banner', compact('promotion'));
    }
}
