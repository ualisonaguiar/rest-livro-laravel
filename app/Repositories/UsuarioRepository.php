<?php

namespace App\Repositories;

use App\Models\Users;
use Illuminate\Pagination\LengthAwarePaginator;

class UsuarioRepository implements UsuarioRepositoryInterface
{
    private const ITENS_POR_PAGINA = 20;

    public function listagem(array $filters = []): LengthAwarePaginator {

        $query = Users::query();

        $perPage = $filters['per_page'] ?? self::ITENS_POR_PAGINA;

        return $query->paginate($perPage)->appends($filters);
    }
}
