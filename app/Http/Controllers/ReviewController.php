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

        $averageRating = CustReview::where('is_published', true)->avg('rating');
        $totalReviews = CustReview::where('is_published', true)->count();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.reviews.grid', compact('reviews'))->render(),
                'pagination' => (string) $reviews->links(),
            ]);
        }

        return view('pages.09-cust-review', compact('reviews', 'averageRating', 'totalReviews'));
    }
}
