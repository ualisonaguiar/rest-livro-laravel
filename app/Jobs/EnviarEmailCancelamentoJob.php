<?php

namespace App\Jobs;

use App\Mail\CompraCanceladaMail;
use App\Models\Venda;
use App\Models\VendaEntrega;
use App\Services\UsuarioService;
use App\Services\VendaEntregaService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class EnviarEmailCancelamentoJob implements ShouldQueue
{
    use Queueable;

    public $tries = 5;
    public $backoff = [10, 30, 60, 120, 300];
    private Venda $venda;

    /**
     * Create a new job instance.
     */
    public function __construct(Venda $venda)
    {
        $this->venda = $venda;
        $this->onQueue('enviar_email_cancelamento');
    }

    /**
     * Execute the job.
     */
    public function handle(UsuarioService $usuarioService): void
    {
        try {
            $usuario = $usuarioService->getById($this->venda->usuario_id);
            $mailable = new CompraCanceladaMail($this->venda);

            Mail::to($usuario->getEmail(), $usuario->getNome())->send($mailable);
        } catch (Throwable $exception) {
            Log::error('Falha ao enviar e-mail: ' . $usuario->getEmail(), [
                'erro' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);

            EnviarEmailFalhaJob::dispatch($usuario->getEmail(), $mailable);
        }
    }
}
