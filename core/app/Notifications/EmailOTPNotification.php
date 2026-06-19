<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EmailOTPNotification extends Notification
{
    use Queueable;

    protected $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Your Email Verification OTP')
                    ->line('Your OTP code is: ' . $this->otp)
                    ->line('The OTP will expire in 10 minutes.')
                    ->line('If you did not request this, please ignore this email.');
    }
}
