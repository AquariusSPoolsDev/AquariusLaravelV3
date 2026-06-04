<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $projects = Project::where('is_published', true)
            ->select('slug', 'updated_at')
            ->orderBy('sort_order')
            ->get();

        $content = view('sitemap.index', compact('projects'))->render();

        return response($content, 200)->header('Content-Type', 'application/xml');
    }
}
