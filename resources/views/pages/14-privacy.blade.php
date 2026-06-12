{{-- PRIVACY PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
    $imageFileLoc   = 'header-privacy.jpg';
    $headerTitle    = 'privacy_display_heading';
    $headerSubtitle = 'privacy_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
   <x-seo.seo
        ogPageTitle="{{__('strings.privacy_title_heading')}}"
        ogDescription="{{__('strings.privacy_subtitle_heading')}}"
        ogImage="{{ asset('assets/images/'.$imageFileLoc) }}"
        :noIndex="true"
    />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
<x-reusables.alert color="warning">
    <strong>{{__('strings.privacy_notice_alert')}}</strong>
</x-reusables.alert>

<strong class="block mt-10 text-neutral-900">{{__('strings.privacy_date_updated_title')}}: {{__('strings.privacy_date_updated')}}</strong>

<div class="">
    <section class="mt-4">
        <h2 class="aquarius-subheading mt-8 uppercase">Introduction</h2>
        <p class="mb-4">
            Aquarius Swimming Pools Sdn Bhd (SSM No. 920548-M) ("the Company", "we", "us", or "our") is committed to
            protecting the privacy of individuals who visit our website at <strong>aquariusswimmingpools.com</strong>
            ("the Website") or contact us through it.
        </p>
        <p class="mb-4">
            This Privacy Policy explains what personal data we collect, why we collect it, how we use and protect it,
            and what rights you have over your data. Please read it carefully. By using this Website or submitting an
            enquiry through it, you agree to the practices described in this policy.
        </p>
        <p class="mb-4">
            This policy applies to personal data collected through this Website only. It does not apply to data
            collected offline or through other channels.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">What Personal Data We Collect</h2>
        <p class="mb-4">
            When you submit an enquiry through our contact form, we collect the following information you provide directly:
        </p>
        <ul class="list-disc pl-6 space-y-2 mb-4">
            <li>Full name</li>
            <li>Email address</li>
            <li>Phone number (including country code)</li>
            <li>Pool interest or service type (e.g. concrete pool, fibreglass pool, pool repair)</li>
            <li>Your enquiry message (optional)</li>
        </ul>
        <p class="mb-4">
            We also collect certain technical data automatically when you visit the Website, including your IP address,
            browser type, operating system, and pages visited. This is collected through cookies and third-party tools
            described below.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">Why We Collect Your Data</h2>
        <p class="mb-4">We use the personal data you provide for the following purposes:</p>
        <ul class="list-disc pl-6 space-y-2 mb-4">
            <li>To respond to your pool enquiry and follow up with you about your project</li>
            <li>To understand your requirements and assess whether we are able to assist you</li>
            <li>To provide you with information about our services, pricing, or process as requested</li>
            <li>To maintain internal records of customer enquiries for business operations</li>
            <li>To improve the Website and our services based on usage patterns</li>
        </ul>
        <p class="mb-4">
            We do not use your personal data for unsolicited marketing, and we do not sell or share it with third
            parties for their own marketing purposes.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">How We Collect Your Data</h2>
        <p class="mb-4">We collect personal data in the following ways:</p>
        <ul class="list-disc pl-6 space-y-2 mb-4">
            <li><strong>Directly from you</strong> — when you fill in and submit the contact form on this Website</li>
            <li><strong>Automatically</strong> — through cookies, session data, and analytics tools when you navigate the Website (see Cookies section below)</li>
        </ul>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">How We Store Your Data</h2>
        <p class="mb-4">
            Enquiry data submitted through the contact form is stored in a secure, access-controlled database hosted
            as part of our website infrastructure. Access is limited to authorised staff only. A copy of each enquiry
            is also delivered by email to our internal team.
        </p>
        <p class="mb-4">
            We retain enquiry records for a maximum of <strong>3 years</strong> from the date of submission, after
            which they are deleted or anonymised unless a longer retention period is required by law or ongoing
            business relationship.
        </p>
        <p class="mb-4">
            We implement reasonable technical and organisational measures to protect your data against accidental loss,
            unauthorised access, alteration, or disclosure. However, no method of internet transmission is completely
            secure, and we cannot guarantee absolute security.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">Cookies and Tracking Technologies</h2>
        <p class="mb-4">
            This Website uses cookies and similar tracking technologies. A cookie is a small file placed on your
            device by your browser when you visit a website.
        </p>
        <p class="mb-4">We use the following types of cookies:</p>
        <ul class="list-disc pl-6 space-y-2 mb-4">
            <li><strong>Session cookie</strong> — a necessary cookie that keeps your browsing session secure. It is deleted when you close your browser.</li>
            <li><strong>Analytics cookies</strong> — set by Google Tag Manager and Google Analytics to help us understand how visitors use the Website (e.g. pages visited, time on site). These cookies may persist across sessions.</li>
        </ul>
        <p class="mb-4">
            You can disable cookies through your browser settings. Note that disabling cookies may affect the
            functionality of some parts of the Website.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">Third-Party Service Providers</h2>
        <p class="mb-4">
            We use the following third-party services to operate this Website. These providers may process your
            data as part of delivering their service to us:
        </p>
        <ul class="list-disc pl-6 space-y-2 mb-4">
            <li>
                <strong>Google Tag Manager &amp; Google Analytics</strong> — used to collect website usage statistics.
                Google may process your IP address and browsing behaviour. See
                <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer" class="font-semibold text-neutral-950 underline underline-offset-4 hover:no-underline">Google's Privacy Policy</a>.
            </li>
            <li>
                <strong>Bunny Fonts</strong> — fonts used on this Website are loaded from a third-party font CDN.
            </li>
            <li>
                <strong>Google Maps</strong> — an embedded map on our Contact page is served by Google. When loaded,
                Google may collect your IP address and set cookies.
            </li>
            <li>
                <strong>Email delivery</strong> — enquiry submissions are forwarded to our team via a third-party
                email hosting provider.
            </li>
            <li>
                <strong>WhatsApp (Meta)</strong> — our website includes a link to our WhatsApp number for direct
                communication. If you choose to use it, your data is subject to
                <a href="https://www.whatsapp.com/legal/privacy-policy" target="_blank" rel="noopener noreferrer" class="font-semibold text-neutral-950 underline underline-offset-4 hover:no-underline">WhatsApp's Privacy Policy</a>.
            </li>
        </ul>
        <p class="mb-4">
            We do not sell your personal data to any of these providers or to any third party.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">International Data Transfers</h2>
        <p class="mb-4">
            Some of the third-party services listed above (Google, Meta/WhatsApp) operate servers outside
            of Malaysia. By using this Website, you acknowledge that your data may be transferred to and processed
            in countries outside Malaysia, including the United States. We take reasonable steps to ensure that any
            such transfers are made only to services with appropriate data protection standards.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">Your Rights</h2>
        <p class="mb-4">Under the <strong>Personal Data Protection Act 2010 (PDPA)</strong> of Malaysia, you have the right to:</p>
        <ul class="list-disc pl-6 space-y-2 mb-4">
            <li>Access the personal data we hold about you</li>
            <li>Request correction of inaccurate or incomplete data</li>
            <li>Request deletion of your personal data from our records</li>
            <li>Withdraw consent to the processing of your personal data</li>
        </ul>
        <p class="mb-4">
            To exercise any of these rights, please contact us by email at
            <a href="mailto:mail@aquariuspools.com.my" class="font-semibold text-neutral-950 underline underline-offset-4 hover:no-underline">mail@aquariuspools.com.my</a>
            or via our <a href="{{ route('contact-page') }}" class="font-semibold text-neutral-950 underline underline-offset-4 hover:no-underline">Contact Us</a> page.
            We will respond to requests within a reasonable timeframe.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">Changes to This Policy</h2>
        <p class="mb-4">
            We may update this Privacy Policy from time to time to reflect changes in our practices or legal
            requirements. The date at the top of this page indicates when the policy was last revised. Continued
            use of the Website after any update constitutes acceptance of the revised policy.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">Contact Information</h2>
        <p class="mb-4">If you have any questions or concerns about this Privacy Policy, please contact us:</p>
        <ul class="list-disc pl-6 space-y-2 mb-4">
            <li><strong>Company:</strong> Aquarius Swimming Pools Sdn Bhd (920548-M)</li>
            <li><strong>Address:</strong> No. 33, Jalan Selatan 3/4, Taman Impian Emas, 81300 Johor Bahru, Johor</li>
            <li><strong>Email:</strong> <a href="mailto:mail@aquariuspools.com.my" class="font-semibold text-neutral-950 underline underline-offset-4 hover:no-underline">mail@aquariuspools.com.my</a></li>
            <li><strong>Office:</strong> <a href="tel:+6075953060" class="font-semibold text-neutral-950 underline underline-offset-4 hover:no-underline">+607 595 3060</a></li>
        </ul>
    </section>
</div>
@endsection
