<?php

namespace App\Providers;

use App\Repositories\LivroRepository;
use App\Repositories\LivroRepositoryInterface;
use App\Services\LivroService;
use App\Services\LivroServiceInterface;
use Illuminate\Support\ServiceProvider;

class LivroProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LivroServiceInterface::class, LivroService::class);
        $this->app->bind(LivroRepositoryInterface::class, LivroRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
