<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    // public function register(): void
    // {
    //
    // }

    /**
     * アプリケーションのルートのパス
     */
    public const HOME = '/dashboard';

    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')->group(base_path('routes/web.php'));
            Route::middleware('web')->group(base_path('routes/auth.php'));
            // Route::middleware(['web', 'auth', 'can:admin'])
            //     ->prefix('admin')
            //     ->group(base_path('routes/admin.php'));

            Route::middleware('api')->prefix('api')->name('api.')
                ->group(base_path('routes/api.php'));
        });
    }
}
