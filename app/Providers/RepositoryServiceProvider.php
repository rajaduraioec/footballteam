<?php

namespace App\Providers;

use App\Interfaces\PlayerRepositoryInterface;
use App\Interfaces\TeamRepositoryInterface;
use App\Repositories\PlayerRepository;
use App\Repositories\TeamRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(PlayerRepositoryInterface::class, PlayerRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
