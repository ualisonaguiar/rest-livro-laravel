<?php

namespace App\Listeners;

use App\Events\CompraRealizadaEvent;
use App\Jobs\EnviarEmailFalhaJob;
use App\Mail\CompraConfirmadaMail;
use App\Services\VendaServiceInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnviarEmailConfirmacaoListener
{
    public function __construct(private VendaServiceInterface $vendaService) {}

    public function handle(CompraRealizadaEvent $event): void
    {
        try {
            Log::info('Listener disparado: enviando email para o cliente...');
            $venda = $this->vendaService->getById($event->vendaEntrega->venda_id);
            $mailable = new CompraConfirmadaMail($event->vendaEntrega, $venda);
            Mail::to($venda->usuario->ds_email)->send($mailable);
        } catch (\Exception $exception) {
            Log::error('Falha ao enviar e-mail: ' . $venda->usuario->ds_email, [
                'erro' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);
            EnviarEmailFalhaJob::dispatch($venda->usuario->ds_email, $mailable);
        }
    }
}
