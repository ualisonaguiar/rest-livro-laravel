<?php

namespace App\Providers;

use App\Repositories\VendaRepository;
use App\Repositories\VendaRepositoryInterface;
use App\Services\VendaService;
use App\Services\VendaServiceInterface;
use Illuminate\Support\ServiceProvider;

class VendaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(VendaServiceInterface::class, VendaService::class);
        $this->app->bind(VendaRepositoryInterface::class, VendaRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
