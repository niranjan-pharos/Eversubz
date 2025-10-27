<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;

// import your classes
use App\View\Components\BusinessCategoryFilter;
use App\View\Components\BusinessCityFilter;
use App\View\Components\BusinessStateCityFilter;
use App\View\Components\PostStateCityFilter;
use App\View\Components\PostCityFilter;
use App\View\Components\Counts;
use App\Helpers\FooterDataHelper;
use App\Models\Wishlist;


class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register any application services.
    }

    public function boot(): void
    {
        // Use Bootstrap pagination UI
        Paginator::useBootstrap();

        /**
         * Force HTTPS only when appropriate.
         * Prefer checking the configured APP_URL scheme or production env.
         */
        $appUrl = config('app.url'); // e.g., https://eversabz.com
        if (app()->environment('production') && Str::startsWith($appUrl, 'https://')) {
            URL::forceScheme('https');
            URL::forceRootUrl(config('app.url'));
        }

        // Optional: force root URL if app is behind unusual proxies
        // if ($appUrl) {
        //     URL::forceRootUrl($appUrl);
        // }

        /**
         * Response macro for no-cache headers (optional).
         * Consider a middleware if you use this widely.
         */
        Response::macro('noCache', function ($response) {
            $response->header('Cache-Control', 'no-store, no-cache, must-revalidate')
                     ->header('Pragma', 'no-cache')
                     ->header('Expires', '0');
            return $response;
        });

        // Share global constants
        View::share('pageTitle', 'Eversabz');

        /**
         * Prefer scoping the composer to the layouts that actually need these variables
         * instead of '*' to avoid running this for every tiny partial.
         * Example: layouts.app, layouts.front, etc.
         */
        View::composer('*', function ($view) {
            // Footer data (consider caching if expensive)
            $footerData = Cache::remember('footer_data', now()->addMinutes(10), function () {
                return FooterDataHelper::getFooterData();
            });
            $view->with('footerData', $footerData);

            // Wishlist count (cache per user)
            $wishlistCount = 0;
            if (Auth::check()) {
                $userId = Auth::id();
                $cacheKey = "wishlist_count_{$userId}";
                $wishlistCount = Cache::remember($cacheKey, now()->addMinutes(1), function () use ($userId) {
                    return Wishlist::where('user_id', $userId)->count();
                });
            }
            $view->with('wishlistCount', $wishlistCount);

            // Business name via proper relationship naming
            $businessName = null;
            if (Auth::check()) {
                $user = Auth::user();
                // assuming relationship method is businessInfos()
                if ($user && $user->relationLoaded('businessInfos')) {
                    $businessName = optional($user->businessInfos)->business_name;
                } else {
                    // avoid N+1 by lazy-loading once; cache if needed
                    $businessName = optional($user?->businessInfos)->business_name;
                }
            }
            $view->with('business_name', $businessName);
        });

        // Register Blade components
        Blade::component('business-category-filter', BusinessCategoryFilter::class);
        Blade::component('business-city-filter', BusinessCityFilter::class);
        Blade::component('business-state-city-filter', BusinessStateCityFilter::class);
        Blade::component('post-state-city-filter', PostStateCityFilter::class);
        Blade::component('post-city-filter', PostCityFilter::class);
        Blade::component('counts', Counts::class);

        /**
         * Global queue failure handler.
         * $event->job is a Job wrapper. Use resolveName() and payload to identify the mailable.
         */
        \Queue::failing(function (JobFailed $event) {
            try {
                $name = $event->job->resolveName(); // class string of the job/command
                $payload = $event->job->payload();

                // Try to detect a SendQueuedMailable (implementation detail may vary per Laravel version)
                $command = data_get($payload, 'data.command');

                $targetEmail = null;
                $orderId = null;

                // If you serialize Mailables, the serialized command often contains "mailable" data.
                // Parse cautiously to avoid unserializing untrusted data.
                if (is_string($command) && str_contains($command, 'SendQueuedMailable')) {
                    // Best-effort regex to grab a "to" address if it’s present (implementation-specific)
                    if (preg_match('/"address";s:\d+:"([^"]+)"/', $command, $m)) {
                        $targetEmail = $m[1] ?? null;
                    }
                }

                Log::error('Queue job failed', [
                    'job'       => $name,
                    'payload'   => array_diff_key($payload, ['data' => true]), // avoid huge logs
                    'email'     => $targetEmail,
                    'order_id'  => $orderId,
                    'exception' => $event->exception->getMessage(),
                ]);
            } catch (\Throwable $e) {
                Log::error('Queue failing handler error', ['e' => $e->getMessage()]);
            }
        });
    }
}
