<?php

namespace App\Mail;

use App\Models\Venda;
use App\Models\VendaEntrega;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CompraConfirmadaMail extends Mailable
{
    use Queueable, SerializesModels;

    private VendaEntrega $vendaEntrega;
    private Venda $venda;

    /**
     * Create a new message instance.
     */
    public function __construct(VendaEntrega $vendaEntrega, Venda $venda)
    {
        $this->vendaEntrega = $vendaEntrega;
        $this->venda = $venda;
    }

    public function build()
    {
        Log::info("Enviando e-mail ao usuário");

        return $this->subject('Confirmação da sua compra!')
            ->view('emails.compras.confirmada')
            ->with([
                'venda' => $this->venda,
                'vendaEntrega' => $this->vendaEntrega,
            ]);
    }
}
