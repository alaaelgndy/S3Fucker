<?php

namespace Elgndy\S3Fucker;

use Illuminate\Support\ServiceProvider;
use Elgndy\S3Fucker\Commands\S3Downloader;

class S3FuckerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes(
            [
            __DIR__.'/Config/elgndy_s3_fucker.php' => config_path('elgndy_s3_fucker.php'),
            ]
        );

        if ($this->app->runningInConsole()) {
            $this->commands([
                S3Downloader::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/elgndy_s3_fucker.php',
            'elgndy_s3_fucker'
        );
    }
}
