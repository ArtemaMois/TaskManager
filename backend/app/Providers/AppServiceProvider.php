<?php

namespace App\Providers;

use App\Services\Auth\AuthService;
use App\Services\Email\EmailService;
use App\Services\VerificationCode\VerificationCodeService;
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
        $this->app->singleton(VerificationCodeService::class, function () {
            return new VerificationCodeService();
        })
    }


    public function boot(): void
    {
        //
    }
}
