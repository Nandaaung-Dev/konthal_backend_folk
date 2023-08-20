<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '';
    protected $system_namespace = 'App\Http\Controllers\Api\System\V1';
    protected $shop_namespace = 'App\Http\Controllers\Api\Shop\V1';
    protected $market_namespace = 'App\Http\Controllers\Api\Market\V1';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
            // Dashboard System Routes
            Route::middleware('web')
                ->prefix('system_dashboard/')
                ->group(base_path('routes/web.php'));
            // Dashboard Shop Routes
            Route::middleware('web')
                ->prefix('shop_dashboard/')
                ->group(base_path('routes/shop.php'));
            // API System Routes
            Route::middleware('api')
                ->prefix('api/system/v1')
                ->namespace($this->system_namespace)
                ->group(base_path('routes/api/v1/system.php'));
            // API Shop Routes
            Route::middleware('api')
                ->prefix('api/shop/v1')
                ->namespace($this->shop_namespace)
                ->group(base_path('routes/api/v1/shop.php'));
            // API Market Routes
            Route::middleware('api')
                ->prefix('api/market/v1')
                ->namespace($this->market_namespace)
                ->group(base_path('routes/api/v1/market.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
