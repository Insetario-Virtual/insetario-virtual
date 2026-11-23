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
        View::composer(['insectary.index', 'admin.insectary.edit'], function ($view) {
            $view->with('orders', Order::orderBy('name', 'asc')->get());
            $view->with('families', Family::orderBy('name', 'asc')->get());
            $view->with('cultures', Culture::orderBy('name', 'asc')->get());
        });
    }
}