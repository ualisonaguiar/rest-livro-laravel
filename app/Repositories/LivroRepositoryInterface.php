<?php

namespace App\Repositories;

use App\Models\Livro;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface LivroRepositoryInterface
{
    public function listagem(array $filters): LengthAwarePaginator;
    public function getById(string $id): Livro;
    public function store(array $data): Livro;
    public function update(array $data, string $id): Livro;
    public function delete($id): Livro;
}
