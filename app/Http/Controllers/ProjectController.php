<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::published()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('pages.17-projects', compact('projects'));
    }

    /**
     * Route parameters arrive in order, so the {locale} prefix comes first even though it isn't used here.
     */
    public function show(string $locale, string $slug): View
    {
        $project = Project::published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.18-project-detail', compact('project'));
    }
}
