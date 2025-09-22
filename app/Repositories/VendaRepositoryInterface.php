<?php

namespace App\Repositories;

use App\Models\Venda;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface VendaRepositoryInterface
{

    public function listagem(array $filters): LengthAwarePaginator;
    public function getById(int $id): Venda;
}
