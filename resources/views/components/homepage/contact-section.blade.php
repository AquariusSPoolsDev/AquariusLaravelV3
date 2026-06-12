<section id="contact" class="bg-white relative overflow-hidden" style="background-image: radial-gradient(125% 125% at 50% 10%, #ffffff 40%, #f59e0b 100%)">
    <div class="main-container">
        <div class="aquarius-contact-main">
            <div class="aquarius-contact-col-left text-center lg:text-start" data-animate data-delay="0">
                <x-reusables.pill-text>{{__('strings.navbar_contact')}}</x-reusables.pill-text>
                <h2 class="aquarius-homepage-heading lg:text-start! text-neutral-950">
                    {{__('strings.contact_heading')}}
                </h2>
                <p class="my-4 text-secondary-950">
                    {{__('strings.contact_desc')}}
                </p>
            </div>
            <div class="aquarius-contact-col-right" data-animate data-delay="150">
                <div class="aquarius-contact-form-card">
                    <x-reusables.contact-form />
                </div>
            </div>
        </div>
    </div>
</section>
