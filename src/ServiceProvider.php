<?php 

namespace Yaro\Gamstop;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Yaro\Gamstop\Gamstop\Api;

class ServiceProvider extends IlluminateServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('yaro.gamstop', function($app) {
            return new Api($app['config']->get('services.gamstop.key'), $app['config']->get('services.gamstop.base_uri'));
        });
    }

}
