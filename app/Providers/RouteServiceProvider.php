<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */

    public function boot(): void
    {

        Route::namespace('App\Http\Controllers')
            ->group(base_path('routes/users.php'));

        Route::namespace('App\Http\Controllers')
            ->group(base_path('routes/transferences.php'));
    }
}
