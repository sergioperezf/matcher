<?php

namespace App\Providers;

use App\Services\LocalGeolocator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Services\LocalGeolocator',
            function($app) {
                return new LocalGeolocator();
            }
        );

        $this->app->bind(
            'App\Services\Geolocator',
            'App\Services\LocalGeolocator'
        );

        $this->app->bind(
            
        );
        //
    }
}
