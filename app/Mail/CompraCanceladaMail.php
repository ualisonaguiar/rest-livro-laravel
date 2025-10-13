<?php

namespace App\Mail;

use App\Models\Venda;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CompraCanceladaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private Venda $venda;

    /**
     * Create a new message instance.
     */
    public function __construct(Venda $venda)
    {
        $this->venda = $venda;
    }

    public function build()
    {
        Log::info("Enviando e-mail de cancelamento ao usuário");

        return $this->subject('Confirmação de cancelamento da sua compra!')
            ->view('emails.compras.cancelada')
            ->with([
                'venda' => $this->venda,
            ]);
    }
}
