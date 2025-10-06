<?php

namespace App\Repositories;

use App\Models\Venda;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VendaRepository implements VendaRepositoryInterface
{
    public function listagem(array $filters): LengthAwarePaginator
    {
        $query = Venda::with(['livro', 'livroEntrega']);

        $this->filterByCpf($query, $filters);

        return $query->paginate(20)->appends($filters);
    }

    public function getById(int $id): Venda
    {
        return Venda::with('livro')->findOrFail($id);
    }

    private function filterByCpf(Builder $query, array $filters): void
    {
        if (isset($filters['nu_cpf'])) {
            $query->where('nu_cpf', '=', $filters['nu_cpf']);
        }
    }
}
