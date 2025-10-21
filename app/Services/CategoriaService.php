<?php

namespace App\Services;

use App\Models\Categoria;
use App\Services\CategoriaServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoriaService implements CategoriaServiceInterface
{
    public function listagem(array $filters): LengthAwarePaginator
    {
        $query = Categoria::query();
        $this->filterByNoCategoria($query, $filters);

        return $query->paginate(20)->appends($filters);
    }

    public function salvar(array $data, ?Categoria $categoria = null): Categoria
    {
        if ($categoria) {
            $categoria->fill($data);
            $categoria->save();
        } else {
            $categoria = Categoria::create($data);
        }

        return $categoria;
    }

    public function getById(int $id): Categoria
    {
        return Categoria::findOrFail($id);
    }

    public function excluir(int $idCategoria): Categoria
    {
        $categoria = $this->getById($idCategoria);
        $categoria->delete();

        return $categoria;
    }

    private function filterByNoCategoria(Builder $query, array $filters): void
    {
        if (isset($filters['no_categoria'])) {
            $query->where('no_categoria', 'like', '%' . $filters['no_categoria'] . '%');
        }
    }
}
