<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
        // Bind the user data to the 'components.header' Blade component
        View::composer('components.header', function ($view) {
            $user = null;
            $flag = 0; // Default value for the flag

            // Check the guard type and retrieve the user accordingly
            if (Auth::guard('web')->check()) {
                $user = Auth::guard('web')->user();
                $flag = 1; // Set the flag to 1
            } elseif (Auth::guard('employee')->check()) {
                $user = Auth::guard('employee')->user();
                // Flag remains 0 (default) for 'employee' guard
            }
    
            $view->with(['user' => $user, 'flag' => $flag]);
        });

    }
}
