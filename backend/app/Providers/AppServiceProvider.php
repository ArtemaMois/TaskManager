<?php

namespace App\Providers;

use App\Services\Auth\AuthService;
use App\Services\Category\CategoryService;
use App\Services\Chat\ChatService;
use App\Services\Claim\ClaimService;
use App\Services\ClaimStatus\ClaimStatusService;
use App\Services\Email\EmailService;
use App\Services\Mentor\MentorService;
use App\Services\Message\MessageService;
use App\Services\Password\ResetPasswordService;
use App\Services\PerformedCheckpoint\PerformedCheckpointService;
use App\Services\PerformingTask\PerformingTaskService;
use App\Services\Role\RoleService;
use App\Services\Task\TaskService;
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
        $this->app->singleton(ResetPasswordService::class, function (){
            return new ResetPasswordService();
        });
        $this->app->singleton(CategoryService::class, function () {
            return new CategoryService();
        });
        $this->app->singleton(ClaimService::class, function () {
            return new ClaimService();
        });
        $this->app->singleton(ClaimStatusService::class, function () {
            return new ClaimStatusService();
        });
        $this->app->singleton(MentorService::class, function () {
            return new MentorService();
        });
        $this->app->singleton(TaskService::class, function () {
            return new TaskService();
        });
        $this->app->singleton(PerformingTaskService::class, function () {
            return new PerformingTaskService();
        });
        $this->app->singleton(PerformedCheckpointService::class, function() {
            return new PerformedCheckpointService();
        });
        
        $this->app->singleton(ChatService::class, function () {
            return new ChatService();
        });
        $this->app->singleton(MessageService::class, function () {
            return new MessageService();
        });

        $this->app->singleton(RoleService::class, function () {
            return new RoleService();
        });
    }


    public function boot(): void
    {
        //
    }
}
