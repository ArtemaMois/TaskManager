<?php

namespace App\Providers;

use App\Services\Auth\AuthService;
use App\Services\Email\EmailService;
use App\Services\Password\ResetPasswordService;
use App\Services\User\UserService;
use App\Services\Verification\VerificationService;
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
        $this->app->singleton(VerificationService::class, function () {
            return new VerificationService();
        });
        $this->app->singleton(UserService::class, function () {
            return new UserService();
        });

        $this->app->singleton(ResetPasswordService::class, function ($app){
            return new ResetPasswordService();
        });
    }


    public function boot(): void
    {
        //
    }
}
