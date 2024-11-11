<?php

namespace App\Listeners\api\Settings;

use App\Events\api\Auth\UserCreatedEvent;
use App\Models\Setting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class CreateUserSettingsListener
{

    public function __construct()
    {
        //
    }

    public function handle(UserCreatedEvent $event): void
    {
        Setting::query()->create([
            'user_id' => $event->user->id
        ]);
    }
}
