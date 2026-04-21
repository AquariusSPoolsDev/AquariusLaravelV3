{{-- TERMS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
    $imageFileLoc   = 'header-promotions.jpg';
    $headerTitle    = 'terms_title_heading';
    $headerSubtitle = 'terms_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
   <x-seo.seo 
        ogPageTitle="{{__('strings.' . $headerTitle)}}"
        ogDescription="{{__('strings.' . $headerSubtitle)}}"
        ogImage="{{ asset('assets/images/'.$imageFileLoc) }}"
    /> 
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
<x-reusables.alert color="warning">
    <strong>{{__('strings.terms_notice_alert')}}</strong>
</x-reusables.alert>

<div class="">
    <section class="mt-10">
        <h2 class="aquarius-subheading mt-8 uppercase">Terms:</h2>
        <p class="mb-4">
            Terms of payment are upon confirmation for service call, maintenance & other charges (depend on the package pick
            by customer). If a past due balance remains unpaid on your account, Aquarius Swimming Pools will make one
            courtesy attempt to contact you via all phone numbers on file. Aquarius Swimming Pools is then hereby authorized
            to charge the credit card supplied on top of this contract or any other credit card on file for the past due
            amount including any incidental charges. A statement will be provided monthly if a balance is present.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">Finance Charges:</h2>
        <p class="mb-4">
            Finance Charges are made on any balances past due according to the following method: (a) Using the unpaid
            balance of your account at the end of the billing period, we multiply this amount by the following monthly
            periodic rate: 1 - 1/2% of the balance, which is an <strong class="text-neutral-900">ANNUAL PERCENTAGE RATE OF 18%</strong>.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">Collection Costs:</h2>
        <p class="mb-4">
            If amounts are not paid as agreed, we may demand immediate payment of the full balance. If the balance is
            referred to a collection agency or attorney for collection, you agree to pay a fee of <strong class="text-neutral-900">1/3 (33%)</strong>
            of the total balance due plus any court costs.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">Irregular Payment or Delay in Enforcement:</h2>
        <p class="mb-4">
            Acceptance of late payments or partial payments, checks or money orders marked <strong class="text-neutral-900">"payment in
                full"</strong> or other statements indicating settlement of your account will not affect any of our rights
            under this agreement. Further, any delay on our part in enforcing our rights under this agreement will not
            affect those rights.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">Changes or Amemdments:</h2>
        <p class="mb-4">
            Changes to this agreement, including payment terms can be made by us as well as amendments this agreement, at
            any time, provided we give you at least <strong class="text-neutral-900">30 days notice</strong> before the beginning of the billing
            period in which the change or amendment becomes effective.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">Cancellation:</h2>
        <p class="mb-4">
            Either we or you can cancel your account any time by providing 30 days written notice. You agree to remain
            responsible for total payment for all purchases made prior to the expiration of the 30 days notice. Failure to
            provide written notice within 30 days of the date of service will result in a voluntary forfeit of your deposit.
            We reserve the right to cancel your account without notice if you do not make payment as agreed.
        </p>
    </section>

    <section class="">
        <h2 class="aquarius-subheading mt-8 uppercase">Liability:</h2>
        <p class="mb-4">
            We are not responsible for any damage or loss caused by failure to make delivery or repair due to labor
            shortage, strikes, manufacturer's failure to deliver or any condition beyond our control. In the event of
            non-payment, and we do not deliver or repair as a result of non-payment, we will not be liable for any damages
            in either a direct or indirect manner. If diagnostic repairs are declined by customer, cleaning and disassembly
            charges on the bottom of this page will still apply.
        </p>
    </section>
</div>

@endsection