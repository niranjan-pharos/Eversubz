<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Square\SquareClient;

class SquareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(SquareClient::class, function ($app) {
            return new SquareClient([
                'accessToken' => env('SQUARE_ACCESS_TOKEN'),
                'environment' => env('SQUARE_ENVIRONMENT'),
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
