<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Venda;

interface VendaServiceInterface {

    public function listagem(array $filters): LengthAwarePaginator;
    public function registrarCompra(array $data): Venda;
    public function atualizarCompra(int $idCompra, array $data): Venda;
    public function excluirCompra(int $idCompra): Venda;
}
