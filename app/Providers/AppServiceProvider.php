<?php

namespace App\Providers;

use App\Services\ProductService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProductService::class, function ($app) {
            return new ProductService();
        });
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);

        // Blade::component('package-alert', Alert::class);
    }
}
