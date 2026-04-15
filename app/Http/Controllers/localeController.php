<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    // Handle both direct URL and form-based locale switching
    public function setLocale(Request $request, $lang = null)
    {
        // If language is set via form, use it; otherwise, get it from URL
        $lang = $lang ?? $request->input('language');

        $localeMap = [
            'en' => 'en_MY',
            'ms' => 'ms_MY'
        ];

        // Convert 'en' or 'ms' to full locale code 'en_MY' or 'ms_MY'
        $selectedLocale = $localeMap[$lang] ?? 'en_MY';

        // Set the application locale and store in session
        App::setLocale($selectedLocale);
        Session::put('locale', $selectedLocale);

        return back(); // Redirect back to the previous page
    }
}