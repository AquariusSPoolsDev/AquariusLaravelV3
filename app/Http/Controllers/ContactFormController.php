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
            'cust_name' => 'required|string|max:80',
            'cust_email' => 'required|email|max:80',
            'country_code' => 'required|string|max:10',
            'cust_phone' => ['required', 'string', 'max:20', 'regex:/^[0-9\-\s]+$/'],
            'cust_pool_interests' => 'required|string|max:60',
            'cust_interest_other' => 'nullable|string|max:120|required_if:cust_pool_interests,Others (Please Specify)',
            'cust_query' => 'nullable|string|max:1000',
            'cust_agree' => 'required|accepted',
        ], $this->validationMessages());

        $recentDuplicate = ContactSubmission::where('email', $data['cust_email'])
            ->where('created_at', '>=', now()->subHours(24))
            ->exists();

        if ($recentDuplicate) {
            return redirect()->route('thank-you');
        }

        $submission = ContactSubmission::create([
            'name' => $data['cust_name'],
            'email' => $data['cust_email'],
            'country_code' => $data['country_code'],
            'phone' => $data['cust_phone'],
            'interest' => $data['cust_pool_interests'] ?? null,
            'interest_other' => $data['cust_interest_other'] ?? null,
            'query' => $data['cust_query'] ?? null,
            'agreed' => true,
        ]);

        try {
            Mail::to('admin@aquariusswimmingpools.com')->send(new ContactFormSubmitted($submission));
        } catch (\Exception $e) {
            \Log::error('Contact form mail failed: '.$e->getMessage());
        }

        return redirect()->route('thank-you');
    }

    /**
     * The same plain, translated messages the browser check shows, so a visitor sees one
     * wording whichever side catches the problem.
     *
     * @return array<string, string>
     */
    private function validationMessages(): array
    {
        return [
            'cust_name.required' => __('strings.cf_err_name_required'),
            'cust_email.required' => __('strings.cf_err_email_required'),
            'cust_email.email' => __('strings.cf_err_email_invalid'),
            'cust_phone.required' => __('strings.cf_err_phone_required'),
            'cust_phone.regex' => __('strings.cf_err_phone_invalid'),
            'cust_pool_interests.required' => __('strings.cf_err_interest_required'),
            'cust_interest_other.required_if' => __('strings.cf_err_other_required'),
            'cust_agree.required' => __('strings.cf_err_agree_required'),
            'cust_agree.accepted' => __('strings.cf_err_agree_required'),
        ];
    }
}
