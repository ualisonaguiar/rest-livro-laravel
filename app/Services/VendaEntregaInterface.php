<?php

namespace App\Services;

use App\Models\VendaEntrega;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface VendaEntregaInterface {

    //public function listagem(array $filters): LengthAwarePaginator;
    public function salvar(array $data): VendaEntrega;
}
