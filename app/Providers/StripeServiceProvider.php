<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Stripe\StripeClient;
class StripeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(StripeClient::class, function ($app) {
            return new StripeClient(config('stripe.secret'));
        });
    }
}
