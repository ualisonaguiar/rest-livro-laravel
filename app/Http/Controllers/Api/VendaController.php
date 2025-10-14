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

    public function index(Request $request): JsonResponse
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

    public function show(int $id): JsonResponse
    {
        try {
            $json = response()->json($this->service->getById($id));
        } catch (\Exception $ex) {
            $json = $this->errorResponse('buscar', $ex, 404);
        }

        return $json;
    }

    public function update(VendaRequest $request, int $idVenda): JsonResponse
    {
        try {
            $venda = $this->service->atualizarCompra($idVenda, $request->validated());
            return response()->json($venda);
        } catch (\Exception $ex) {
            return $this->errorResponse('atuaizar', $ex, 404);
        }
    }

    public function destroy(int $idVenda): JsonResponse
    {
        try {
            $venda = $this->service->excluirCompra($idVenda);

            return response()->json($venda);
        } catch (\Exception $ex) {
            return $this->errorResponse('excluir', $ex, 404);
        }
    }
}
