<?php

namespace Tests\Feature;

use App\Enums\SitePage;
use App\Models\ContactSubmission;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/**
 * The contact form checks its fields in the browser first (no reload on an empty submit), and the
 * server repeats the same checks with the same plain, translated messages.
 */
class ContactFormValidationTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        foreach (SitePage::cases() as $page) {
            $page->setVisible(true);
        }

        Mail::fake();
    }

    /**
     * @return array<string, string>
     */
    private function validSubmission(): array
    {
        return [
            'cust_name' => 'Ali bin Abu',
            'cust_email' => 'ali.'.uniqid().'@example.com',
            'country_code' => '+60',
            'cust_phone' => '12-345 6789',
            'cust_pool_interests' => 'Tiled Concrete Pools',
            'cust_agree' => '1',
        ];
    }

    public function test_the_form_checks_fields_in_the_browser_with_translated_messages(): void
    {
        $html = $this->get('/ms/contact-us')->assertOk()->getContent();

        $this->assertStringContainsString('x-data="contactForm(', $html);
        $this->assertStringContainsString('@submit="submit($event)"', $html);
        $this->assertStringContainsString('Sila masukkan nama anda.', $html);
        $this->assertStringContainsString('Sila bersetuju dengan Dasar Privasi', $html);
        $this->assertStringNotContainsString('field is required', $html);
    }

    public function test_error_messages_wait_hidden_until_there_is_a_problem(): void
    {
        $html = $this->get('/en/contact-us')->assertOk()->getContent();

        foreach (['cust_name', 'cust_email', 'cust_phone', 'cust_pool_interests', 'cust_agree'] as $field) {
            $this->assertMatchesRegularExpression('/<p id="'.$field.'-error"[^>]*x-bind:hidden="!hasError\(\''.$field.'\'\)"[^>]*\shidden\s*>/', $html);
        }

        $this->assertStringNotContainsString('aria-invalid="true"', $html);
    }

    public function test_the_phone_field_lets_shortcuts_and_enter_through(): void
    {
        $html = $this->get('/en/contact-us')->assertOk()->getContent();

        $this->assertStringContainsString('$event.key.length === 1 && !$event.ctrlKey && !$event.metaKey', $html);
    }

    public function test_an_empty_submit_from_the_server_side_gets_plain_translated_messages(): void
    {
        $this->get('/ms/contact-us');

        $this->post('/send-email', [])->assertSessionHasErrors([
            'cust_name' => 'Sila masukkan nama anda.',
            'cust_email' => 'Sila masukkan alamat emel anda.',
            'cust_phone' => 'Sila masukkan nombor telefon anda.',
            'cust_pool_interests' => 'Sila pilih perkara yang anda minati.',
            'cust_agree' => 'Sila bersetuju dengan Dasar Privasi supaya kami boleh membalas anda.',
        ]);
    }

    public function test_server_errors_show_under_their_fields_and_mark_them_invalid(): void
    {
        $this->get('/en/contact-us');
        $this->from('/en/contact-us')->post('/send-email', ['cust_email' => 'not-an-email'])->assertRedirect('/en/contact-us');

        $html = $this->get('/en/contact-us')->assertOk()->getContent();

        $this->assertMatchesRegularExpression('/<p id="cust_email-error"[^>]*>Please enter a valid email address, like name@example.com.<\/p>/', $html);
        $this->assertMatchesRegularExpression('/id="cust_email"[^>]*aria-invalid="true"/s', $html);
    }

    public function test_phone_numbers_with_letters_are_rejected(): void
    {
        $this->get('/en/contact-us');

        $this->post('/send-email', ['cust_phone' => '012-abc'] + $this->validSubmission())
            ->assertSessionHasErrors(['cust_phone' => __('strings.cf_err_phone_invalid')]);
    }

    public function test_others_needs_a_description(): void
    {
        $this->get('/en/contact-us');

        $this->post('/send-email', ['cust_pool_interests' => 'Others (Please Specify)'] + $this->validSubmission())
            ->assertSessionHasErrors(['cust_interest_other' => __('strings.cf_err_other_required')]);
    }

    public function test_a_complete_submission_still_goes_through(): void
    {
        $data = $this->validSubmission();

        $this->post('/send-email', $data)->assertRedirect(route('thank-you'))->assertSessionHasNoErrors();

        $this->assertTrue(ContactSubmission::where('email', $data['cust_email'])->where('phone', '12-345 6789')->exists());
    }
}
