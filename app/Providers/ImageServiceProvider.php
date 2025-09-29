<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManager;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Bind the ImageManager with configuration using an array for the driver
        $this->app->singleton(ImageManager::class, function ($app) {
            return new ImageManager(['driver' => 'gd']); // You can use 'imagick' if preferred and installed
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
