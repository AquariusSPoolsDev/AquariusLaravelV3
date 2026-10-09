<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        $promotions = Promotion::query()
            ->active()
            ->orderBy('start_time')
            ->paginate(5);

        $totalActive = $promotions->total();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.promotions.grid', compact('promotions'))->render(),
                'pagination' => (string) $promotions->links(),
            ]);
        }

        return view('pages.12-promotions', compact('promotions', 'totalActive'));
    }
}
