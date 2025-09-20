<?php

namespace App\Services;

use App\Models\Livro;
use App\Repositories\LivroRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LivroService implements LivroServiceInterface
{
    public function __construct(private LivroRepositoryInterface $repository) {}

    public function listagem(array $filters): LengthAwarePaginator {
        return $this->repository->listagem($filters);
    }

    public function store(array $data): Livro {
        return $this->repository->store($data);
    }

    public function getById(string $id): Livro {
        return $this->repository->getById($id);
    }

    public function update(array $data, string $id): Livro {
        return $this->repository->update($data, $id);
    }

    public function delete($id): Livro {
        return $this->repository->delete($id);
    }
}