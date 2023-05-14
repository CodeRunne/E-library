<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $excel = App::make('excel');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        Filament::serving(function () {
            Filament::registerViteTheme('resources/css/filament.css');
        });
    }
}