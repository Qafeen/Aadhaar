<?php

namespace Qafeen\Aadhaar;

use Illuminate\Support\ServiceProvider;

class AadhaarServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('aadhaar', function ($app) {
            return new Aadhaar();
        });
    }
}
