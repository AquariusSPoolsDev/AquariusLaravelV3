<?php

namespace App\Notifications;

use Filament\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Filament's admin password-reset email, sent under the admin sender name so it is not
 * mistaken for a website enquiry. Bound in place of Filament's class in AppServiceProvider.
 */
class AdminResetPassword extends ResetPassword
{
    /**
     * @param  mixed  $notifiable
     */
    public function toMail($notifiable): MailMessage
    {
        return parent::toMail($notifiable)
            ->from(config('mail.from.address'), config('mail.sender_names.admin'));
    }
}
