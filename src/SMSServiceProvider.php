<?php

namespace CraftedSystems\LaravelSMS;

use CraftedSystems\LaravelSMS\Console\MakeGatewayCommand;
use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/sms.php' => config_path('sms.php'),
        ], 'laravel_sms_config');

        $this->app->singleton(SMS::class, function () {
            return new SMS();
        });

        $this->app->alias(SMS::class, 'sms');

        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeGatewayCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/sms.php', 'laravel-sms'
        );
    }
}
