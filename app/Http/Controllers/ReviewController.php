<?php

namespace App\Http\Controllers;

use App\Models\CustReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = CustReview::where('is_published', true)
            ->orderBy('reviewed_at', 'desc')
            ->paginate(12);

        $averageRating = CustReview::where('is_published', true)->where('source', 'Google Reviews')->avg('rating');
        $totalReviews = CustReview::where('is_published', true)->where('source', 'Google Reviews')->count();
        $fbTotal = CustReview::where('is_published', true)->where('source', 'Facebook')->count();
        $fbRecommended = $fbTotal;

        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.reviews.grid', compact('reviews'))->render(),
                'pagination' => (string) $reviews->links(),
            ]);
        }

        return view('pages.09-cust-review', compact('reviews', 'averageRating', 'totalReviews', 'fbTotal', 'fbRecommended'));
    }
}
