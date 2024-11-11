<?php

namespace App\Console\Commands;

use App\Extensions\RabbitMQ\Enums\Exchange\ExchangeEnum;
use App\Extensions\RabbitMQ\Facades\RabbitMQ;
use Illuminate\Console\Command;

class RabbitInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создает начальные exchange и queue;';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        RabbitMQ::declareExchange('laravel', ExchangeEnum::Direct, false, true, false);
        RabbitMQ::declareQueue('verification-email', false, true, false, false);
        RabbitMQ::bindQueue('verification-email', 'laravel', 'verification', []);
    }
}
