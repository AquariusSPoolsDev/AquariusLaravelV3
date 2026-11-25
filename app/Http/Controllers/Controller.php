<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

abstract class Controller
{
    /**
     * The answer to an AJAX page change: the list's new HTML and its pagination links
     * (read by resources/js/ajax-pagination.js).
     *
     * @param  array<string, mixed>  $data
     */
    protected function paginatedPartial(string $view, array $data, LengthAwarePaginator $paginator): JsonResponse
    {
        return response()->json([
            'html' => view($view, $data)->render(),
            'pagination' => (string) $paginator->links(),
            'total' => $paginator->total(),
        ]);
    }
}
