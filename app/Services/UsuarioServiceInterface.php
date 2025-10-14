<?php

namespace App\Services;

use App\Models\Users;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UsuarioServiceInterface
{
    public function listagem(array $filters = []): LengthAwarePaginator;
    public function store(array $data): Users;
    public function getById(int $id): Users;
    // public function update(array $data, string $id): Livro;
    // public function delete($id): Livro;
    // public function realizarBaixaEstoque(int $idLivro, int $quantidade): Livro;
}
