<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use App\Models\ContactSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function sendEmail(Request $request): RedirectResponse
    {
        // Honeypot — bots fill this, humans don't
        if ($request->filled('website')) {
            return redirect()->route('thank-you');
        }

        $data = $request->validate([
            'cust_name'           => 'required|string|max:80',
            'cust_email'          => 'required|email|max:80',
            'country_code'        => 'required|string|max:10',
            'cust_phone'          => 'required|string|max:20',
            'cust_pool_interests' => 'nullable|string|max:60',
            'cust_interest_other' => 'nullable|string|max:120|required_if:cust_pool_interests,Others (Please Specify)',
            'cust_query'          => 'nullable|string|max:1000',
            'cust_agree'          => 'required|accepted',
        ]);

        $recentDuplicate = ContactSubmission::where('email', $data['cust_email'])
            ->where('created_at', '>=', now()->subHours(24))
            ->exists();

        if ($recentDuplicate) {
            return redirect()->route('thank-you');
        }

        $submission = ContactSubmission::create([
            'name'           => $data['cust_name'],
            'email'          => $data['cust_email'],
            'country_code'   => $data['country_code'],
            'phone'          => $data['cust_phone'],
            'interest'       => $data['cust_pool_interests'] ?? null,
            'interest_other' => $data['cust_interest_other'] ?? null,
            'query'          => $data['cust_query'] ?? null,
            'agreed'         => true,
        ]);

        Mail::to('admin@aquariusswimmingpools.com')->send(new ContactFormSubmitted($submission));

        return redirect()->route('thank-you');
    }
}
