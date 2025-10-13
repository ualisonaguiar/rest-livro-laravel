<?php

namespace App\Jobs;

use App\Models\Venda;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessaEnviaNotaFiscalJob implements ShouldQueue
{
    use Queueable;

    private Venda $venda;

    /**
     * Create a new job instance.
     */
    public function __construct(Venda $venda)
    {
        $this->venda = $venda;
        $this->onQueue('fila_enviar_nota_fiscal');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Processando a nota fiscal da venda: #' . $this->venda->id);
    }
}
