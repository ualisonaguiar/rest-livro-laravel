<?php

namespace App\Services;

use App\Clients\Cep\WsConsultaCepInterface;
use Illuminate\Support\Facades\Log;

class CepService implements CepServiceInterface
{
    public function __construct(private WsConsultaCepInterface $clientWsCep) {}

    public function buscarCep(string $cep): array
    {
        try {
            return $this->clientWsCep->buscarCep($cep);
        } catch (\DomainException $exception) {
            Log::error(
                'failed search cep: ' . $cep . ' - message: ' . $exception->getMessage(),
                ['exception' => $exception]
            );
            throw $exception;
        }
    }
}
