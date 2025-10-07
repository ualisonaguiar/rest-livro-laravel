<?php

namespace App\Clients\Cep;

interface WsConsultaCepInterface
{
    public function buscarCep(string $cep): array;
}
