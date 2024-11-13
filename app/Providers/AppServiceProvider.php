<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\ServiceProvider;  // Ensure the Notification model is imported

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

        view()->composer('*', function ($view) {
            $notifications = Notification::all();
            $view->with(['notifications' => $notifications]);
        });
    }
}
