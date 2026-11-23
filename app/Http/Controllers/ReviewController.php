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
            return $this->paginatedPartial('components.reviews.grid', compact('reviews'), $reviews);
        }

        return view('pages.09-cust-review', [
            'reviews' => $reviews,
            'reviewSummary' => CustReview::platformSummary(),
        ]);
    }
}
