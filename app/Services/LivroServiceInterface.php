<?php

namespace App\Services;

use App\Models\Livro;
use App\Models\Product;

interface LivroServiceInterface
{
    public function listagem();
    public function getById(string $id): Livro;
    public function store(array $data): Livro;
    public function update(array $data, string $id): Livro;
    public function delete($id): Livro;
}
