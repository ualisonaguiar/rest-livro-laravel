<?php

namespace App\Events;

use App\Models\VendaEntrega;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CompraRealizadaEvent
{
    use Dispatchable, SerializesModels;

    public VendaEntrega $vendaEntrega;

    public function __construct(VendaEntrega $vendaEntrega)
    {
        $this->vendaEntrega = $vendaEntrega;
    }
}
