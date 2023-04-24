<?php

namespace App\Providers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment(config('telescope.environments'))) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RedirectResponse::macro('success', function ($message) {
            return $this->with('success', $message);
        });
        RedirectResponse::macro('error', function ($message) {
            return $this->with('error', $message);
        });
        RedirectResponse::macro('warning', function ($message) {
            return $this->with('warning', $message);
        });
        RedirectResponse::macro('info', function ($message) {
            return $this->with('info', $message);
        });
    }
}
