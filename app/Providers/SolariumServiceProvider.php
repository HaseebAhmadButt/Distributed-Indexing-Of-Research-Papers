<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Solarium\Client;
use Solarium\Core\Client\Adapter\Curl;
use Symfony\Component\EventDispatcher\EventDispatcher;

class SolariumServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Register any application services.
     *
     * @return  void
     */
    public function register()
    {

        $this->app->bind(Client::class, function () {
            $adapter = new Curl();
            $eventDispatcher = new EventDispatcher();
            return new Client($adapter,$eventDispatcher,config('solarium'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        return [Client::class];
    }
}
