<?php

namespace App\Http\Controllers;

use App\Models\CustReview;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        $reviews = CustReview::query()
            ->published()
            ->latest('reviewed_at')
            ->paginate(12);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.reviews.grid', compact('reviews'))->render(),
                'pagination' => (string) $reviews->links(),
            ]);
        }

        return view('pages.09-cust-review', [
            'reviews' => $reviews,
            'reviewSummary' => CustReview::platformSummary(),
        ]);
    }
}
