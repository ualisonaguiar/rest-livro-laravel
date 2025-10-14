<?php

namespace App\Providers;

use App\Services\CategoriaService;
use App\Services\CategoriaServiceInterface;
use Illuminate\Support\ServiceProvider;

class CategoriaProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoriaServiceInterface::class, CategoriaService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
