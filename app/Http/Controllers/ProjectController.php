<?php

namespace App\Http\Controllers;

use App\Models\Project;

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

    public function show(string $slug)
    {
        $project = Project::published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.18-project-detail', compact('project'));
    }
}
