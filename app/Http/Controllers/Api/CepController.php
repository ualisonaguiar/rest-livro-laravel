<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CepServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CepController extends Controller
{
    public function __construct(private CepServiceInterface $service) {}

    public function buscarCep(String $cep): JsonResponse
    {
        Log::info("search cep: " . $cep);
        try {
            $json = response()->json($this->service->buscarCep($cep));
        } catch (\DomainException $exception) {
            $json =  response()->json([
                'message' => "Erro ao busar o {$cep}.",
                'error'   => $exception->getMessage(),
            ], 404);
        }

        return $json;
    }
}
