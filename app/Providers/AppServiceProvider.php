<?php

namespace App\Providers;

use App\Algorithms\KMeansExtended;
use App\Services\LocalGeolocator;
use App\Services\NetGeolocator;
use App\Services\RedundantGeolocator;
use dotzero\GMapsGeocode;
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
        $this->app->singleton(
            'App\Services\LocalGeolocator',
            function($app) {
                return new LocalGeolocator();
            }
        );

        $this->app->bind(
            'App\Services\NetGeolocator',
            function($app) {
                $tf = $app->make('dotzero\GMapsGeocode');
                return new NetGeolocator($tf);
            }
        );

        $this->app->bind(
            'App\Services\RedundantGeolocator',
            function($app) {
                $localGeolocator = $app->make('App\Services\LocalGeolocator');
                $netGeolocator = $app->make('App\Services\NetGeolocator');
                return new RedundantGeolocator($localGeolocator, $netGeolocator);
            }
        );

        $this->app->bind(
            'App\Services\Geolocator',
            'App\Services\RedundantGeolocator'
        );

        $this->app->bind(
            'App\Algorithms\KMeansExtended',
            function ($app) {
                return new KMeansExtended(2);
            }
        );

        $this->app->bind('dotzero\GMapsGeocode',
            function ($app) {
                $key = env('GOOGLE_MAPS_KEY');
                return new GMapsGeocode($key);
            }
        );
    }
}
