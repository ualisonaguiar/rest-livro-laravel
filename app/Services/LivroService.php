<?php

namespace App\Services;

use App\Exceptions\BusinessRuleException;
use App\Models\Livro;
use App\Repositories\LivroRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LivroService implements LivroServiceInterface
{
    public function __construct(private LivroRepositoryInterface $repository) {}

    public function listagem(array $filters): LengthAwarePaginator
    {
        return $this->repository->listagem($filters);
    }

    public function store(array $data): Livro
    {
        return $this->repository->store($data);
    }

    public function getById(int $id): Livro
    {
        try {
            return $this->repository->getById($id);
        } catch (ModelNotFoundException $ex) {
            throw new ModelNotFoundException("Livro com ID {$id} não encontrado.");
        }
    }

    public function update(array $data, string $id): Livro
    {
        return $this->repository->update($data, $id);
    }

    public function delete($id): Livro
    {
        return $this->repository->delete($id);
    }

    public function realizarBaixaEstoque(int $id, int $quantidade): Livro
    {
        $livro = $this->getById($id);
        if ($quantidade > $livro->nu_quantidade) {
            throw new BusinessRuleException('Não há estoque suficiente para essa venda.');
        }

        $livro->nu_quantidade -= $quantidade;
        $livro->save();
        return $livro;
    }
}
