<?php 

namespace App\Extensions\Centrifugo\Providers;

use App\Extensions\Centrifugo\Connection\CentrifugoConfig;
use App\Extensions\Centrifugo\Connection\CentrifugoConnection;
use App\Extensions\Centrifugo\Services\CentrifugoService;
use Illuminate\Support\ServiceProvider;

class CentrifugoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CentrifugoConfig::class, function () {
            return new CentrifugoConfig();
        });

        $this->app->singleton(CentrifugoConnection::class, function () {
            return new CentrifugoConnection($this->app->get(CentrifugoConfig::class));
        });

        $this->app->singleton(CentrifugoService::class, function ()
        {
            return new CentrifugoService($this->app->get(CentrifugoConnection::class));
        });
    }

    public function boot()
    {

    }
}