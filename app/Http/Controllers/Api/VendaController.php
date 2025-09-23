<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\VendaServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\VendaRequest;

class VendaController extends Controller
{
    public function __construct(
        private VendaServiceInterface $service
    ) {}

    public function listagem(Request $request): JsonResponse
    {
        return response()->json($this->service->listagem($request->query()));
    }

    public function store(VendaRequest $request): JsonResponse
    {
        try {
            $venda = $this->service->registrarCompra($request->validated());

            return response()->json($venda);
        } catch (\Exception $ex) {
            return $this->errorResponse('inserir', $ex, 404);
        }
    }

    public function update(VendaRequest $request, int $idLivro): JsonResponse
    {
        try {
            $venda = $this->service->atualizarCompra($idLivro, $request->validated());

            return response()->json($venda);
        } catch (\Exception $ex) {
            return $this->errorResponse('atuaizar', $ex, 404);
        }
    }

    public function destroy(int $idLivro): JsonResponse
    {
        try {
            $venda = $this->service->excluirCompra($idLivro);

            return response()->json($venda);
        } catch (\Exception $ex) {
            return $this->errorResponse('excluir', $ex, 404);
        }
    }

    private function errorResponse(string $action, \Exception $ex, int $status = 500): JsonResponse
    {
        return response()->json([
            'message' => "Erro ao {$action} a compra.",
            'error'   => $ex->getMessage(),
        ], $status);
    }
}
