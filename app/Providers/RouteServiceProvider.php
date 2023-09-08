<?php

namespace App\Providers;

use App\Models\FormApplication;
use App\Models\FormType;
use App\Models\Order;
use App\Models\Site;
use App\Models\Size;
use App\Models\Style;
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
        Route::bind('formApplication', function ($value) {
            return FormApplication::query()->findOrFail($value);
        });

        Route::bind('formType', function ($value) {
            return FormType::query()->findOrFail($value);
        });

        Route::bind('site', function ($value) {
            return Site::query()->findOrFail($value);
        });

        Route::bind('size', function ($value) {
            return Size::query()->findOrFail($value);
        });

        Route::bind('style', function ($value) {
            return Style::query()->findOrFail($value);
        });

        Route::bind('order', function ($value) {
            return Order::query()->findOrFail($value);
        });


        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
