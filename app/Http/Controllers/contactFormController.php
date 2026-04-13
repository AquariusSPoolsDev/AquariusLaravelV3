<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\sendContactForm;
class contactFormController extends Controller
{

    public function sendEmail(Request $request)
    {
        $data = $request->validate([
            'cust_name'             => 'required|string|max:80',
            'cust_email'            => 'required|string|max:80',
            'cust_phone'            => 'required|string|max:20',
            'cust_pool_interests'   => 'required|string|max:40',
            'cust_query'            => 'required|string|max:255',
            'cust_callback_date'    => 'required|string|max:20',
            'cust_callback_time'    => 'required|string|max:20',
            'cust_agree'            => 'required|accepted',
        ]);

        \Notification::route('mail','admin@aquariusswimmingpools.com')->notify(new sendContactForm($data));
        return redirect()->route('thank-you');
        
    }
}
