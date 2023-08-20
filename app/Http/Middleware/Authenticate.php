<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Config;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            \Log::info("Middleware: Exceptedjson");
            $type = $request->segments()[0];
            if ($type == 'shop_dashboard') {
                Config::set('auth.defaults.guard', 'owner');
                return route('shop_dashboard_login');
            }
            Config::set('auth.defaults.guard', 'web');
            return route('login');
        } else {
            $type = $request->segments()[1];
            \Log::info("Middleware: : Type is: " . $type);
            if ($type == 'shop') {
                Config::set('auth.defaults.guard', 'owner');
                return route('shop_api_login');
            }
        }
        return;
    }
}
