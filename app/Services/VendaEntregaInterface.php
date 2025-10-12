<?php

namespace App\Services;

use App\Models\VendaEntrega;

interface VendaEntregaInterface
{
    public function salvar(array $data): VendaEntrega;
}
