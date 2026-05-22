<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = Review::latest()->paginate(12);
        $averageRating = Review::avg('rating');
        $totalReviews = Review::count();

        return view('pages.09-cust-review', compact('reviews', 'averageRating', 'totalReviews'));
    }
}
