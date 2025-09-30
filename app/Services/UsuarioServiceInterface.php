<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Auth\User;

interface UsuarioServiceInterface
{
    public function listagem(array $filters = []): LengthAwarePaginator;
    public function store(array $data): User;
    // public function getById(int $id): Livro;
    // public function update(array $data, string $id): Livro;
    // public function delete($id): Livro;
    // public function realizarBaixaEstoque(int $idLivro, int $quantidade): Livro;
}
