<?php

namespace App\Services;

use App\Exceptions\BusinessRuleException;
use App\Jobs\BuscaCepVendaEntrega;
use App\Repositories\VendaRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Venda;
use App\Models\Livro;
use Illuminate\Support\Facades\DB;

class VendaService implements VendaServiceInterface
{
    public function __construct(
        private VendaRepositoryInterface $repository,
        private LivroServiceInterface $livroService
    ) {}

    public function listagem(array $filters): LengthAwarePaginator
    {
        return $this->repository->listagem($filters);
    }

    public function getById(int $id): Venda
    {
        return Venda::findOrFail($id);
    }

    public function registrarCompra(array $data): Venda
    {
        return DB::transaction(function () use ($data) {
            $livro = $this->livroService->getById($data['livro_id']);
            $this->validarQuantidadeDisponivel($livro, $data['nu_quantidade']);

            $venda = $this->prepareEntityVenda($data, $livro);
            $venda->save();

            $this->livroService->realizarBaixaEstoque($livro->id, $data['nu_quantidade']);

            $data['venda_id'] = $venda->id;
            BuscaCepVendaEntrega::dispatch($data);

            return $venda;
        });
    }

    public function atualizarCompra(int $idCompra, array $data): Venda
    {
        return DB::transaction(function () use ($idCompra, $data) {
            $venda = $this->repository->getById($idCompra);
            $livro = Livro::lockForUpdate()->findOrFail($venda->livro->id);

            if ($data['nu_quantidade'] == $venda->nu_quantidade) {
                throw new BusinessRuleException('Quantidade solicitada é a mesma presente na venda.');
            }

            $diferenca = $data['nu_quantidade'] - $venda->nu_quantidade;

            // se a diferença for positiva, valida se há estoque suficiente
            if ($diferenca > 0) {
                $this->validarQuantidadeDisponivel($livro, $diferenca);
            }

            $this->ajustarEstoque($livro, $diferenca);

            $venda->nu_quantidade = $data['nu_quantidade'];
            $venda->save();

            $data['venda_id'] = $venda->id;
            BuscaCepVendaEntrega::dispatch($data);

            return $venda;
        });
    }
    public function excluirCompra(int $idCompra): Venda
    {
        return DB::transaction(function () use ($idCompra) {
            $venda = $this->repository->getById($idCompra);
            $this->ajustarEstoque($venda->livro, -$venda->nu_quantidade);
            $venda->delete();
            return $venda;
        });
    }

    private function validarQuantidadeDisponivel(Livro $livro, int $quantidade): void
    {
        if ($quantidade > $livro->nu_quantidade) {
            throw new BusinessRuleException('Quantidade de livros solicitada acima do estoque.');
        }
    }

    private function prepareEntityVenda(array $data, Livro $livro): Venda
    {
        $venda = new Venda();
        $venda->nu_cpf = $data['nu_cpf'];
        $venda->livro_id = $livro->id;
        $venda->nu_preco = $livro->nu_preco;
        $venda->nu_quantidade = $data['nu_quantidade'];

        return $venda;
    }

    private function ajustarEstoque(Livro $livro, int $diferenca)
    {
        $livro->nu_quantidade -= $diferenca;
        $livro->save();
    }
}
