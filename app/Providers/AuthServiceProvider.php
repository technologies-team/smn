<?php

namespace App\Providers;

use Fouladgar\OTP\Notifications\Messages\OTPMessage;
use Fouladgar\OTP\Notifications\OTPNotification;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        OTPNotification::toSMSUsing(fn($notifiable, $token) =>(new OTPMessage())
            ->to($notifiable->mobile)
            ->content('Your OTP Token is: '.$token));

        //Email Customization
        OTPNotification::toMailUsing(fn ($notifiable, $token) =>(new MailMessage)
            ->subject('OTP Request')
            ->line('Your OTP Token is: '.$token));    }
}
