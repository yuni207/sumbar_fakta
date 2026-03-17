<?php

namespace App\Providers;

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
        // AppServiceProvider.php
        view()->share('setting', \App\Models\Setting::first());
        view()->share('running_news', \App\Models\Post::latest()->limit(5)->get());
    }
}
