<?php

namespace App\Providers;

use App\Composers\UpcomingCompetitionsComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;

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
        Facades\View::composer('*', UpcomingCompetitionsComposer::class);
    }
}
