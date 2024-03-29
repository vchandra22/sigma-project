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
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/user/dashboard';
    public const ADMIN_DASHBOARD = '/admin/dashboard';
    public const MENTOR_DASHBOARD = '/mentor/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // route untuk halaman frontend
            Route::middleware(['web'])
                ->namespace($this->namespace . '\Frontend')
                ->group(base_path('routes/frontend.php'));

            Route::middleware(['web'])
                ->prefix('user')
                ->namespace($this->namespace . '\User')
                ->group(base_path('routes/user.php'));

            Route::middleware(['web'])
                ->prefix('admin')
                ->namespace($this->namespace . '\Admin')
                ->group(base_path('routes/admin.php'));

            Route::middleware(['web'])
                ->prefix('mentor')
                ->namespace($this->namespace . '\Mentor')
                ->group(base_path('routes/mentor.php'));
        });
    }
}
