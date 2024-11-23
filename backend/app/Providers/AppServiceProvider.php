<?php

namespace App\Providers;

use App\Services\Auth\AuthService;
use App\Services\Category\CategoryService;
use App\Services\Claim\ClaimService;
use App\Services\ClaimStatus\ClaimStatusService;
use App\Services\Email\EmailService;
use App\Services\Mentor\MentorService;
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
        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryService();
        });
        $this->app->singleton(ClaimService::class, function ($app) {
            return new ClaimService();
        });
        $this->app->singleton(ClaimStatusService::class, function ($app) {
            return new ClaimStatusService();
        });
        $this->app->singleton(MentorService::class, function ($app) {
            return new MentorService();
        });
    }


    public function boot(): void
    {
        //
    }
}
