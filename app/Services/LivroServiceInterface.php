<?php

namespace App\Services;

use App\Models\Livro;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface LivroServiceInterface
{
    public function listagem(array $filters): LengthAwarePaginator;
    public function getById(int $id): Livro;
    public function store(array $data): Livro;
    public function update(array $data, string $id): Livro;
    public function delete($id): Livro;
    public function realizarBaixaEstoque(int $idLivro, int $quantidade): Livro;
}
