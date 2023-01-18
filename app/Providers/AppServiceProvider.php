<?php

namespace App\Providers;

use App\Helpers\Cleanup;
use Illuminate\Support\Facades\View;
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
        $this->app->bind(Cleanup::class, function () {
            return new Cleanup($this->app->get('filesystem'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $analytics = env('ANALYTICS');
        if ($analytics) {
            View::share('analytics', $analytics);
        }
        $ads = env('SHOW_ADS');
        if ($ads) {
            View::share('ads', $ads);
        }
    }
}
