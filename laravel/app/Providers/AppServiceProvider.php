<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('nl');

        //Admin middleware @admin
        Blade::if('admin', function() {
            return auth()->user()->role === 3;
        });

        //Developer middleware @developer
        Blade::if('developer', function() {
            return auth()->user()->role >= 2;
        });
    }
}
