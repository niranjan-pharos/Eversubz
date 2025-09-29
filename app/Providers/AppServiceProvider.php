<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Http\Response;
use App\Helpers\FooterDataHelper;
use Illuminate\Support\ServiceProvider;
use App\Models\Wishlist;
use App\View\Components\PostStateCityFilter;
use App\View\Components\PostCityFilter;
use App\View\Components\BusinessCategoryFilter;
use App\View\Components\BusinessCityFilter;
use App\View\Components\BusinessStateCityFilter;
use App\View\Components\Counts;   


class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register any application services.
    }

    public function boot(): void
    {
        Paginator::useBootstrap();

        // Force HTTPS in non-local environments (for production)
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        Response::macro('noCache', function ($response) {
            $response->header('Cache-Control', 'no-store, no-cache, must-revalidate')
                     ->header('Pragma', 'no-cache')
                     ->header('Expires', '0');
            return $response;
        });

        /*
        \DB::listen(function($query) {
            \Log::info('SQL Executed', [
                'sql' => $query->sql,
                'bindings' => $query->bindings,
                'time' => $query->time
            ]);
        });*/

        // Existing shared data
        View::share('pageTitle', 'Eversabz');

        // Existing view composer logic with enhancements
        View::composer('*', function ($view) {
            // Share footer data
            $footerData = FooterDataHelper::getFooterData();
            $view->with('footerData', $footerData);

            // Share wishlist count with caching
            $wishlistCount = 0;
            if (Auth::check()) {
                $cacheKey = 'wishlist_count_' . Auth::id();
                $wishlistCount = Cache::remember($cacheKey, 60, function () {
                    return Wishlist::where('user_id', Auth::id())->count();
                });
            }
            $view->with('wishlistCount', $wishlistCount);

            // Share business name with all views
            $businessName = null;
            if (Auth::check()) {
                $user = Auth::user();
                if ($user && $user->BusinessInfos) { // Corrected to BusinessInfos relationship
                    $businessName = $user->BusinessInfos->business_name ?? null;
                }
            }
            $view->with('business_name', $businessName);
        });

        // Register the Blade components
        Blade::component('business-category-filter', BusinessCategoryFilter::class);
        Blade::component('business-city-filter', BusinessCityFilter::class);
        Blade::component('business-state-city-filter', BusinessStateCityFilter::class);
        Blade::component('post-state-city-filter', PostStateCityFilter::class);
        Blade::component('post-city-filter', PostCityFilter::class);
        Blade::component('counts', Counts::class);

        // Add global queue failure handler for email notifications
        Queue::failing(function (JobFailed $event) {
            $job = $event->job;
            $exception = $event->exception;

            if ($job instanceof \Illuminate\Mail\SendQueuedMailable) {
                $mailable = $job->mailable;
                if ($mailable instanceof \App\Mail\CustomerOrderConfirmationMail) {
                    Log::error('Failed to process customer email', [
                        'email' => $mailable->to[0]['address'] ?? 'unknown',
                        'error' => $exception->getMessage()
                    ]);
                } elseif ($mailable instanceof \App\Mail\VendorOrderNotificationMail) {
                    Log::error('Failed to process vendor email', [
                        'email' => $mailable->to[0]['address'] ?? 'unknown',
                        'order_id' => $mailable->order->id ?? 'unknown',
                        'error' => $exception->getMessage()
                    ]);
                } elseif ($mailable instanceof \App\Mail\AdminOrderNotificationMail) {
                    Log::error('Failed to process admin email', [
                        'email' => $mailable->to[0]['address'] ?? 'unknown',
                        'error' => $exception->getMessage()
                    ]);
                }
            }
        });
    }
}