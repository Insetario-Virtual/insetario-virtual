<?php

namespace App\Providers;

use App\Models\Culture;
use App\Models\Family;
use App\Models\Order;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('insects.index', function ($view) {
            $view->with('orders', Order::all());
            $view->with('families', Family::all());
            $view->with('cultures', Culture::all());
        });
    }
}