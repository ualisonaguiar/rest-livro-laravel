<?php

namespace App\Http\Controllers;

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

    public function store(VendaRequest $request)
    {
        try {
            $venda = $this->service->registrarCompra($request->validated());

            return response()->json($venda);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Erro ao realizar a compra. Erro: ' . $ex->getMessage(),
            ], 404);
        }
    }

    public function edit(VendaRequest $request, $idLivro) {
        try {
            $venda = $this->service->atualizarCompra(intval($idLivro), $request->validated());

            return response()->json($venda);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Erro ao atualizar a compra. Erro: ' . $ex->getMessage(),
            ], 404);
        }
    }

    public function destroy($idLivro) {
        try {
            $venda = $this->service->excluirCompra(intval($idLivro));

            return response()->json($venda);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Erro ao atualizar a compra. Erro: ' . $ex->getMessage(),
            ], 404);
        }
    }
}
