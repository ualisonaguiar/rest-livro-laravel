<?php

namespace App\Clients\Cep;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ViaCepClient implements WsConsultaCepInterface
{
    public function buscarCep(string $cep): array
    {
        try {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
            if ($response->failed()) {
                throw new \DomainException("Falha ao consultar CEP: {$cep}. HTTP Code: {$response->status()}");
            }

            $data = $response->json();
            if (empty($data) || (isset($data['erro']) && $data['erro'] == true)) {
                throw new \DomainException("CEP não encontrado: {$cep}");
            }

            return $data;
        } catch (\Exception $exception) {
            Log::error("Erro ao buscar CEP: {$cep} - mensagem: {$exception->getMessage()}");
            throw $exception;
        }
    }
}
