<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('min_duration', function ($attribute, $value, $parameters, $validator) {
            // Ensure the value is in the HH:MM:SS format
            $pattern = '/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/';
            if (!preg_match($pattern, $value)) {
                return false;
            }

            // Calculate total minutes
            list($hours, $minutes, $seconds) = explode(':', $value);
            $totalMinutes = $hours * 60 + $minutes;

            // Check if the duration is 30 minutes or more
            return $totalMinutes >= 30;
        });
    }
}
