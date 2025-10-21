<?php

namespace App\Services;

use App\Models\Categoria;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoriaServiceInterface
{

    public function listagem(array $filters): LengthAwarePaginator;
    public function salvar(array $data, ?Categoria $categoria = null): Categoria;
    public function getById(int $id): Categoria;
    public function excluir(int $idCategoria): Categoria;
}
