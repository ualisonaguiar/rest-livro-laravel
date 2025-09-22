<?php

namespace App\Services;

use App\Repositories\VendaRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VendaService implements VendaServiceInterface
{
    public function __construct(private VendaRepositoryInterface $repository) {}

    public function listagem(array $filters): LengthAwarePaginator
    {
        return $this->repository->listagem($filters);
    }
}
