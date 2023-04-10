<?php

namespace App\Providers;

use App\Services\PlayerService;
use App\Services\TeamService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TeamService::class, function ($app) {
            return new TeamService();
        });

        $this->app->singleton(PlayerService::class, function ($app) {
            return new PlayerService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
