<?php

namespace App\Services;

interface CepServiceInterface
{
    public function buscarCep(string $cep): array;
}
