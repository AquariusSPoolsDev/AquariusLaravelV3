<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now('Asia/Kuala_Lumpur');

        $promotions = Promotion::where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->orderBy('start_time')
            ->paginate(5);

        $totalActive = Promotion::where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->count();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.promotions.grid', compact('promotions'))->render(),
                'pagination' => (string) $promotions->links(),
            ]);
        }

        return view('pages.12-promotions', compact('promotions', 'totalActive'));
    }
}
