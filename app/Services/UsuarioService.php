<?php

namespace App\Services;

use App\Jobs\EnvioEmailCadastroUsuarioJob;
use App\Models\Users;
use App\Repositories\UsuarioRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioService implements UsuarioServiceInterface
{
    public function __construct(private UsuarioRepositoryInterface $repository) {}

    public function listagem(array $filters = []): LengthAwarePaginator
    {

        return $this->repository->listagem($filters);
    }

    public function store(array $data): Users
    {
        return DB::transaction(function () use ($data) {
            $senha = $this->gerarSenha();
            $data['ds_senha'] = $senha['hash'];

            $usuario = Users::create($data);

            EnvioEmailCadastroUsuarioJob::dispatch($usuario, $senha['senha']);

            return $usuario;
        });
    }

    private function gerarSenha(): array
    {
        $senha = Str::random(10);
        return [
            'senha' => $senha,
            'hash' => Hash::make($senha)
        ];
    }
}
