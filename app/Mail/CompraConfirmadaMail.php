<?php

namespace App\Mail;

use App\Models\vendaEntrega;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CompraConfirmadaMail extends Mailable
{
    use Queueable, SerializesModels;

    private vendaEntrega $vendaEntrega;

    /**
     * Create a new message instance.
     */
    public function __construct(vendaEntrega $vendaEntrega)
    {
        $this->vendaEntrega = $vendaEntrega;
    }

    public function build()
    {
        Log::info("Preparando o envio...");
        
        return $this->subject('Confirmação da sua compra!')
                    ->view('emails.compras.confirmada');
    }
}
