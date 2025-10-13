<?php

namespace App\Jobs;

use App\Services\VendaEntregaInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

class BuscaCepVendaEntrega implements ShouldQueue
{
    use Queueable;

    public $tries = 5;
    public $backoff = [10, 30, 60, 120, 300];

    /**
     * Create a new job instance.
     */
    public function __construct(private array $data)
    {
        $this->onQueue('fila_busca_cep');
    }

    /**
     * Execute the job.
     */
    public function handle(VendaEntregaInterface $serviceVendaEntrega): void
    {
        Log::info("Buscando CEP: " . $this->data['nu_cep']);
        try {
            $serviceVendaEntrega->salvar($this->data);
        } catch (Throwable $exception) {
            Log::error("Failed search CEP: " . $this->data['nu_cep']);
            throw $exception;
        }
    }
}
