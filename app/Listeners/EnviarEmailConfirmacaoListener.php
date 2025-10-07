<?php

namespace App\Listeners;

use App\Events\CompraRealizadaEvent;
use App\Mail\CompraConfirmadaMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnviarEmailConfirmacaoListener
{
    public function handle(CompraRealizadaEvent $event): void
    {
        Log::info('Listener disparado: enviando email para o cliente...');

        Mail::to('ualison.aguiar@gmail.com')->send(new CompraConfirmadaMail($event->vendaEntrega));
    }
}
