{{-- PRIVACY PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.def-temp')

{{-- PARSE HEADER STRINGS --}}
@php
    $imageFileLoc   = 'header-privacy.jpg';
    $headerTitle    = 'privacy_title_heading';
    $headerSubtitle = 'privacy_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
   <x-seo 
        ogPageTitle="{{__('strings.' . $headerTitle)}}"
        ogDescription="{{__('strings.' . $headerSubtitle)}}"
        ogImage="{{ asset('assets/images/'.$imageFileLoc) }}"
    /> 
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
<x-alert-notification class="text-secondary-800 bg-secondary-50 border-secondary-200">
    <x-slot name="alert">
        <strong>{{__('strings.privacy_notice_alert')}}</strong>
    </x-slot>
</x-alert-notification>

<strong class="mt-10">{{__('strings.privacy_date_updated_title')}}: {{__('strings.privacy_date_updated')}}</strong>

<div class="">
    <section class="mt-4">
        <h2 class="uppercase  text-3xl">Introduction</h2>
        <p class="">
            At Aquarius Swimming Pools &lpar;the "Company" or "We"&rpar;, we respect your privacy and are committed to
            protecting it through our compliance with this policy.
        </p>
        <p class="">
            This policy describes the types of information we may collect from you or that you may provide when you visit
            this website &lpar;our "Website"&rpar; and our practices for collecting, using, maintaining, protecting and
            disclosing that information.
        </p>

        <strong class="">This policy applies to information we collect:</strong>
        <ul class="list-disc">
            <li>
                On this Website.
            </li>
            <li>
                
                In e-mail, text and other electronic messages between you and this Website.
            </li>
            <li>
                Through mobile and desktop applications you
                download from this Website, which provide dedicated non-browser-based interaction between you and this
                Website.
            </li>
            <li>
                When you interact with our advertising and
                applications on third-party websites and services, if those applications or advertising include links to
                this policy.
            </li>
        </ul>

        <strong class="">It does not apply to information collected by:</strong>
        <ul class="list-disc">
            <li>us offline or through any other means,
                including on any oter website operated by Company or any third party &lpar;including our affiliates and
                subsidiaries&rpar;; or
            </li>
            <li>
                any third party &lpar;including our
                affiliates
                and subsidiaries&rpar;, including through any application or content &lpar;including advertising&rpar; that
                may link to or
                be accessible from or on the Website.</li>
        </ul>
        <p class="">
            Please read this policy carefully to understand our policies and practices regarding your information and how we
            will treat it. If you do not agree with our policies and practices, your choice is not to use our Website. By
            accessing or using this Website, you agree to this privacy policy. This policy may change from time to time.
            Your continued use of this Website after we make changes is deemed to be acceptance of those changes, so please
            check the policy periodically for updates.
        </p>
    </section>

    <section class="">
        <h2 class="uppercase  text-3xl">Information we collect about you and how we collect it</h2>

        <strong class="">We collect several types of information from and about users of our Website, including
            information:</strong>
        <ul class="list-disc">
            <li>by which you may be personally identified,
                such as name, postal address, e-mail address, telephone number or ANY OTHER INFORMATION THE WEBSITE COLLECTS
                THAT IS DEFINED AS PERSONAL OR PERSONALLY IDENTIFIABLE INFORMATION UNDER AN APPLICABLE LAW &lpar;"personal
                information"&rpar;;</li>
            <li>that is about you but individually does not
                identify you, and/or</li>
            <li>about your internet connection, the
                equipment you use to access our Website and usage details.</li>
        </ul>

        <strong class="">We collect this information:</strong>
        <ul class="list-disc">
            <li>Directly from you when you provide it to us.
            </li>
            <li>Automatically as you navigate through the
                site. Information collected automatically may include usage details, IP addresses and information collected
                through cookies, web beacons and other tracking technologies.</li>
            <li>From third parties, for example, our
                business partners.</li>
        </ul>
    </section>

    <section class="">
        <h2 class="uppercase  text-3xl">Information you provide to us</h2>
        <strong class="">The information we collect on or through our Website may include:</strong>
        <ul class="list-disc">
            <li>Information that you provide by filling in
                forms on our Website. This includes information provided at the time of registering to use our Website,
                subscribing to our service, posting material or requesting further services. We may also ask you for
                information when you report a problem with our Website.</li>
            <li>Records and copies of your correspondence
                &lpar;including e-mail addresses&rpar;, if you contact us.</li>
            <li>Your responses to surveys that we might ask
                you to complete for research purposes.</li>
            <li>Details of transactions you carry out
                through our Website and of the fulfillment of your orders. You may be required to provide financial
                information before placing an order through our Website.</li>
            <li>Your search queries on the Website.</li>
        </ul>
        <p class="">You also may provide information to be published or displayed &lpar;hereinafter, “posted”&rpar; on
            public areas of the Website, or transmitted to other users of the Website or third parties &lpar;collectively,
            “User Contributions”&rpar;. Your User Contributions are posted on and transmitted to others at your own risk.
            Although we limit access to certain pages/you may set certain privacy settings for such information by logging
            into your account profile, please be aware that no security measures are perfect or impenetrable. Additionally,
            we cannot control the actions of other users of the Website with whom you may choose to share your User
            Contributions. Therefore, we cannot and do not guarantee that your User Contributions will not be viewed by
            unauthorized persons.</p>
    </section>

    <section class="">
        <h2 class="uppercase  text-3xl">Information We Collect through Automatic Data Collection Technologies</h2>
        <p class="">As you navigate through and interact with our Website, we may use automatic data collection
            technologies to
            collect certaininformation about your equipment, browsing actions and patterns, including:</p>
        <ul class="list-disc">
            <li>Details of your visits to our Website,
                including trafficdata, location data, and other communication data and the resources that you access and use
                on the Website.</li>
            <li>Information about your computer and internet
                connection,including your IP address, operating system and browser type.</li>
        </ul>
        <p class="">We also may use these technologies to collect information about your online activities over time
            and across third-party websites or other online services (behavioral tracking). The information we collect
            automatically is statistical data and does not include personal information, but we may maintain it or associate
            it with personal information we collect in otherways or receive from third parties. It helps us to improve our
            Website and to deliver a better and more personalized service,including by enabling us to:</p>
        <ul class="list-disc">
            <li>Estimate our audience size and usage
                patterns.</li>
            <li>Store information about your preferences,
                allowing us to customize our Website according to your individual interests.</li>
            <li>Speed up your searches.</li>
            <li>Recognize you when you return to our
                Website.</li>
        </ul>
        <p class="">The technologies we use for this automatic data collection may include:</p>
        <ul class="list-disc">
            <li>Cookies &lpar;or browser cookies&rpar;. A
                cookie is a small file placed on the hard drive of your computer. You may refuse to accept browser cookies
                by
                activating the appropriatesetting on your browser. However, if you select this setting you may be unable to
                access certain parts of our Website.Unless you have adjusted your browser setting so that it will refuse
                cookies, our system will issue cookies when youdirect your browser to our Website.</li>
            <li>Web Beacons. Pages of our the Website may
                contain small electronic files known as web beacons &lpar;also referred to as clear gifs. pixel tags and
                single-pixel gifs&rpar; that permit the Company, for example, to count users who have visited those pages or
                opened an e-mail and for other related website statistics &lpar;for example, recording the popularity of
                certain website content and verifying system and server integrity&rpar;.</li>
        </ul>
        <p class="">We do not collect personal Information automatically, but we may tie this information to personal
            information about you that we collect from other sources or you provide to us.</p>
    </section>

    <section class="">
        <h2 class="uppercase  text-3xl">Third-party Use Of Cookies And Other Tracking Technologies</h2>
        <p class="">Some content or applications, including advertisements, on the Website are served by
            third-parties, including advertisers, ad networks and servers, content providers and application providers.
            These third parties may use cookies alone or in conjunction with web beacons or other tracking technologies to
            collect information about you when you use our website. The information they collect may be associated with your
            personal information or they may collect information, including personal information, about your online
            activities over time and across different websites and other online services. They may use this information to
            provide you with interest-based &lpar;behavioral&rpar; advertising or other targeted content.</p>
        <p class="">We do not control these third parties' tracking technologies or how they may be used. If you have
            any questions about an advertisement or other targeted content, you should contact the responsible provider
            directly.</p>
    </section>

    <section class="">
        <h2 class="uppercase  text-3xl">How We Use Your Information</h2>
        <p class="">We use information that we collect about you or that you provide to us, including any personal
            information:</p>
        <ul class="fa-ul">
            <li>To present our Website and its contents to
                you.</li>
            <li>To provide you with information, products or
                services that you request from us.</li>
            <li>To provide you with information about our
                services</li>
            <li>To provide you with notices about your
                account/subscription,including expiration and renewal notices.</li>
            <li>To carry out our obligations and enforce our
                rights arising from any contracts entered into between you and us, including for billing and collection.
            </li>
            <li>To notify you about changes to our Website
                or anyproducts or services we offer or provide though it.</li>
            <li>To allow you to participate in interactive
                featureson our Website.</li>
            <li>In any other way we may describe when you
                provide the information.</li>
            <li>To fulfill any purpose for which you
                provide it.</li>
            <li>For any other purpose with your consent.
            </li>
        </ul>
        <p class="">We may use the information we have collected from you to enable us to display advertisements to
            our advertisers' target audiences. Even though we do not disclose your personal information for these purposes
            without your consent, if you click on or otherwise interact with an advertisement, the advertiser may assume
            that you meet its target criteria.</p>
    </section>

    <section class="">
        <h2 class="uppercase  text-3xl">Disclosure Of Your Information</h2>
        <p class="">We may disclose aggregated information about our users, and information that does not identify
            any individual, without restriction.</p>
        <p class="">We may disclose personal information that we collect or you provide as described in this privacy
            policy:</p>
        <ul class="list-disc">
            <li>To our subsidiaries and affiliates.</li>
            <li>To contractors, service providers and
                other third parties we use to support our business and who are bound by contractual obligations to keep
                personal information confidential and useit only for the purposes for which we disclose it to them.</li>
            <li>To a buyer or other successor in the event
                of a merger, divestiture, restructuring, reorganization, dissolution or other sale or transfer of some or
                all of the Company's assets, whether as a going concern or as part of bankruptcy, liquidation or similar
                proceeding, in which personal information held by the Company about our Website users is among the assets
                transferred.</li>
            <li>To third parties to market their products
                or services to you if you have consented to these disclosures. We contractually require these third parties
                to keep personal informationconfidential and use it only for the purposes for which we disclose it to them.
            </li>
            <li>To fulfill the purpose for which you
                provide it. For example,if you give us an e-mail address to use the “e-mail a friend” feature of our
                Website, we will transmit the contents of that e-mail and your e-mail address to the recipients.</li>
            <li>For any other purpose disclosed by us when
                you providethe information.</li>
            <li>With your consent.</li>
        </ul>
        <p class="">We may also disclose your personal information:</p>
        <ul class="list-disc">
            <li>To comply with any court order, law or
                legal process, including to respond to any government or regulatory request.</li>
            <li>To enforce or apply our terms of use and
                other agreements, including for billing and collection purposes.</li>
            <li>If we believe disclosure is necessary or
                appropriate to other companies and organizations for the purposes of fraud protection and credit risk
                reduction.</li>
        </ul>
    </section>

    <section class="">
        <h2 class="uppercase  text-3xl">Choices About How We Use And Disclose Your Information</h2>
        <p class="">We strive to provide you with choices regarding the personal information you provide to us. We
            have created mechanisms to provide you with the following control over your information:</p>
        <ul class="list-disc">
            <li>Tracking Technologies and Advertising. You
                can set your browser to refuse all or some browser cookies, or to alert you when cookies are being sent. If
                you disable or refuse cookies, please note that some parts of this site may then be inaccessible or not
                function properly.</li>
            <li>We do not control third parties'
                collection or use of your information to serve interest-based advertising. However these third parties may
                provide you with ways to choose not to have your information collected or used in this way. </li>
        </ul>
    </section>

    <section class="">
        <h2 class="uppercase  text-3xl">Accessing and Correcting Your Information</h2>
        <p class="">You may send us an e-mail via our contact link to request access to, correct or delete any
            personal information that you have provided to us. We cannot delete your personal information except by also
            deleting your user account. We may not accommodate a request to change information if we believe the change
            would violate any law or legal requirement or cause the information to be incorrect.</p>
        <p class="">If you delete your User Contributions from the Website, copies of your User Contributions may
            remain viewable in cached and archived pages, or might have been copied or stored by other Website users. Proper
            access and use of information provided on the Website, including User Contributions, is governed by our terms of
            use.</p>
    </section>

    <section class="">
        <h2 class="uppercase  text-3xl">Data Security</h2>
        <p class="">We have implemented measures designed to secure your personal information from accidental loss
            and from unauthorized access, use, alteration and disclosure.</p>
        <p class="">The safety and security of your information also depends on you. Where we have given you &lpar;or
            where you have chosen&rpar; a password for access to certain parts of our Website, you are responsible for
            keeping this password confidential. We ask you not to share your password with anyone.</p>
        <p class="">Unfortunately, the transmission of information via the internet is not completely secure.
            Although we do our best to protect your personal information, we cannot guarantee the security of your personal
            information transmitted to our Website. Any transmission of personal information is at your own risk. We are not
            responsible for circumvention of any privacy settings or security measures contained on the Website.</p>
    </section>

    <section class="">
        <h2 class="uppercase  text-3xl">Changes to Our Privacy Policy</h2>
        <p class="">It is our policy to post any changes we make to our privacy policy on this page. If we make
            material changes to how we treat our users' personal information, we will notify you by e-mail to the e-mail
            address specified in your account and/or through a notice on the Website home page. The date the privacy policy
            was last revised is identified at the top of the page. You are responsible for ensuring we have an up-to-date
            active and deliverable e-mail address for you, and for periodically visiting our Website and this privacy policy
            to check for any changes.</p>
    </section>

    <section class="">
        <h2 class="uppercase  text-3xl">Contact Information</h2>
        <p class="">To ask questions or comment about this privacy policy and our privacy practices, contact via our
            <a href="{{ route('contact-page') }}" class="underline font-semibold hover:no-underline text-primary-900">Contact Us</a> link.</p>
        <p class="">Thank You for Visiting the Website.</p>
    </section>
</div>
@endsection