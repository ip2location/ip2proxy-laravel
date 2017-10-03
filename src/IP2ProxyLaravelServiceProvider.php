<?php

namespace Ip2location\IP2ProxyLaravel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class IP2ProxyLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('ip2proxylaravel', IP2ProxyLaravel::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
		//Dynamically add IP2ProxyLaravel alias
		AliasLoader::getInstance()->alias('IP2ProxyLaravel', 'Ip2location\IP2ProxyLaravel\Facade\IP2ProxyLaravel');
		
        $config = __DIR__.'/Config/ip2proxylaravel.php';

        $this->publishes([
            $config => config_path('ip2proxylaravel.php'),
        ], 'config');

        $this->mergeConfigFrom( $config, 'ip2proxylaravel');

        // $this->app['ip2proxylaravel'] = $this->app->share(function($app){
            // return new IP2ProxyLaravel;
        // });
    }
}
