<?php

namespace App\Providers;

use App\Repositories\UsuarioRepository;
use App\Repositories\UsuarioRepositoryInterface;
use App\Services\UsuarioService;
use App\Services\UsuarioServiceInterface;
use Illuminate\Support\ServiceProvider;

class UsuarioProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UsuarioServiceInterface::class, UsuarioService::class);
        $this->app->bind(UsuarioRepositoryInterface::class, UsuarioRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
