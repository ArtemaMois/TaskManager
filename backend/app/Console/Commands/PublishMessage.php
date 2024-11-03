<?php

namespace App\Console\Commands;

use App\Extensions\RabbitMQ\Facades\RabbitMessage;
use App\Extensions\RabbitMQ\Facades\RabbitMQ;
use App\Models\User;
use Illuminate\Console\Command;

class PublishMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit:publish';

    protected $description = 'Publish message to queue';

    public function handle()
    {
        // $user = User::query()->create([
        //     'login' => 'nick',
        //     'email' => 'rt.rk.ra@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role_id' => 3
        // ]);
        // $emailMessage = RabbitMessage::makeMessage(\App\Jobs\api\Email\SendVerificationCodeJob::class, $user);
        // RabbitMQ::publish($emailMessage, 'laravel', 'verification');
    }
}
