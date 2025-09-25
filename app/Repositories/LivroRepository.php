<?php

namespace App\Repositories;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class LivroRepository implements LivroRepositoryInterface
{
    private const ITENS_POR_PAGINA = 20;

    public function listagem(array $filters): LengthAwarePaginator
    {
        $query = Livro::query();

        $this->filterOperadorLike($query, 'no_nome', $filters);
        $this->filterOperadorLike($query, 'no_autor', $filters);
        $this->filterBetweenDtLancemento($query, $filters);
        $this->applyOrdenacao($query, $filters);

        $perPage = $filters['per_page'] ?? self::ITENS_POR_PAGINA;

        return $query->paginate($perPage)->appends($filters);
    }


    public function getById(string $id): Livro
    {
        return Livro::findOrFail($id);
    }

    public function store(array $data): Livro
    {
        return Livro::create($data);
    }

    public function update(array $data, string $id): Livro
    {
        $livro = $this->getById($id);
        $livro->update($data);

        return $livro;
    }

    public function delete($id): Livro
    {
        $product = $this->getById($id);
        Livro::destroy($id);

        return $product;
    }

    private function filterBetweenDtLancemento(Builder $query, array $filters): void
    {
        if (isset($filters['dt_lancamento_start']) && isset($filters['dt_lancamento_end'])) {
            $query->whereBetween('dt_lancamento', [$filters['dt_lancamento_start'], $filters['dt_lancamento_end']]);
        }
    }

    private function filterOperadorLike(Builder $query, string $nomeCampo, array $filters): void
    {
        if (isset($filters[$nomeCampo])) {
            $query->when($filters[$nomeCampo], fn($q) => $q->where($nomeCampo, 'ilike', "%{$filters[$nomeCampo]}%"));
        }
    }

    private function applyOrdenacao(Builder $query, array $filters): void
    {
        $allowedSorts  = (new Livro())->getFillable();
        $allowedOrders = ['asc', 'desc'];

        $sort  = Arr::get($filters, 'sort', 'dt_lancamento');
        $order = Str::lower(Arr::get($filters, 'order', 'asc'));

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'dt_lancamento';
        }

        if (!in_array($order, $allowedOrders)) {
            $order = 'asc';
        }

        $query->orderBy($sort, $order);
    }
}
