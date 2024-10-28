<?php

namespace App\Providers;

use App\Services\Auth\AuthService;
use App\Services\Email\EmailService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{


    public function register(): void
    {
        $this->app->singleton(AuthService::class, function () {
            return new AuthService();
        });
        $this->app->singleton(EmailService::class, function() {
            return new EmailService();
        });
    }


    public function boot(): void
    {
        //
    }
}
