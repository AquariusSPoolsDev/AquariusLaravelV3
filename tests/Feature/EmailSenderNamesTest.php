<?php

namespace Tests\Feature;

use App\Mail\ContactFormSubmitted;
use App\Models\User;
use App\Notifications\AdminResetPassword;
use Filament\Auth\Pages\PasswordReset\RequestPasswordReset;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Each kind of email has its own sender name, so staff can tell a website enquiry from an
 * admin email in the inbox. Both use the global "from" address.
 *
 * phpunit.xml points at the development MySQL database. Every test runs inside a transaction
 * that is rolled back afterwards, so the submission and throwaway user are never kept.
 */
class EmailSenderNamesTest extends TestCase
{
    use DatabaseTransactions;

    public function test_website_enquiries_come_from_the_website_and_reply_to_the_customer(): void
    {
        Mail::fake();
        $email = 'sender-test.'.uniqid().'@example.com';

        $this->post('/send-email', [
            'cust_name' => 'Ali bin Abu',
            'cust_email' => $email,
            'country_code' => '+60',
            'cust_phone' => '12-345 6789',
            'cust_pool_interests' => 'Tiled Concrete Pools',
            'cust_agree' => '1',
        ])->assertRedirect(route('thank-you'));

        Mail::assertSent(ContactFormSubmitted::class, function (ContactFormSubmitted $mail) use ($email): bool {
            return $mail->hasFrom(config('mail.from.address'), 'Aquarius Web')
                && $mail->hasReplyTo($email, 'Ali bin Abu')
                && $mail->hasTo('admin@aquariusswimmingpools.com');
        });
    }

    public function test_admin_password_reset_emails_come_from_the_admin_panel(): void
    {
        Notification::fake();
        Filament::setCurrentPanel('admin');

        // The users table has no email_verified_at column, so the default factory cannot insert.
        $user = User::query()->create([
            'name' => 'Sender Tester',
            'email' => 'sender-tester@aquariusswimmingpools.com',
            'password' => 'password',
        ]);

        Livewire::test(RequestPasswordReset::class)
            ->fillForm(['email' => $user->email])
            ->call('request')
            ->assertHasNoFormErrors();

        Notification::assertSentTo($user, AdminResetPassword::class, function (AdminResetPassword $notification) use ($user): bool {
            $mail = $notification->toMail($user);

            return $mail->from === [config('mail.from.address'), 'Aquarius Admin Panel']
                && $mail->actionUrl === $notification->url
                && str_contains($notification->url, 'token=');
        });
    }

    public function test_the_sender_names_are_different(): void
    {
        $this->assertSame('Aquarius Web', config('mail.sender_names.enquiries'));
        $this->assertSame('Aquarius Admin Panel', config('mail.sender_names.admin'));
    }
}
