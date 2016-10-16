<?php

namespace Qafeen\Aadhaar;

use Illuminate\Support\ServiceProvider;
use Validator;

class AadhaarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('valid_aadhaar', function () {
            return app('aadhaar')->isValid();
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('aadhaar', function ($app) {
            return $app->make(Aadhaar::class);
        });
    }
}
