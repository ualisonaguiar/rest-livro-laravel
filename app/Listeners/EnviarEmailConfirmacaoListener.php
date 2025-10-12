<?php

namespace App\Listeners;

use App\Events\CompraRealizadaEvent;
use App\Mail\CompraConfirmadaMail;
use App\Services\VendaService;
use App\Services\VendaServiceInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnviarEmailConfirmacaoListener
{
    public function __construct(private VendaServiceInterface $vendaService) {}

    public function handle(CompraRealizadaEvent $event): void
    {
        Log::info('Listener disparado: enviando email para o cliente...');

        $venda = $this->vendaService->getById($event->vendaEntrega->venda_id);

        Mail::to($venda->usuario->ds_email)->send(new CompraConfirmadaMail($event->vendaEntrega, $venda));
    }
}
