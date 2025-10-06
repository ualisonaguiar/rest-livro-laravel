<?php

namespace App\Providers;

use App\Clients\Cep\ViaCepClient;
use App\Clients\Cep\WsConsultaCepInterface;
use App\Services\CepService;
use App\Services\CepServiceInterface;
use Illuminate\Support\ServiceProvider;

class CepProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CepServiceInterface::class, CepService::class);

        //providers client ws cep
        $this->app->bind(WsConsultaCepInterface::class, ViaCepClient::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
