<?php

namespace App\Repositories;

use App\Models\Venda;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VendaRepository implements VendaRepositoryInterface
{
    public function listagem(array $filters): LengthAwarePaginator
    {
        $query = Venda::query();

        return $query->paginate(20)->appends($filters);
    }
}