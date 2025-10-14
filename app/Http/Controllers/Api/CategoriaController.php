<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use App\Services\CategoriaServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function __construct(private CategoriaServiceInterface $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json($this->service->listagem($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaRequest $request)
    {
        try {
            $categoria = $this->service->salvar($request->validated());

            return response()->json([
                'message' => 'Categoria criada com sucesso.',
                'data' => $categoria,
            ], 201);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Erro ao criar categoria no banco de dados.',
                'details' => $e->getMessage(),
            ], 500);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Erro inesperado ao criar categoria.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $categoria = $this->service->getById($id);
            return response()->json([
                'data' => $categoria,
            ], 201);
        } catch (ModelNotFoundException $ex) {
            return response()->json(['error' => 'Categoria não encontrada.', 'details' => $ex->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        try {
            $this->service->salvar($request->validated(), $categoria);

            return response()->json([
                'message' => 'Categoria salva com sucesso.',
                'data' => $categoria,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Categoria não encontrada.'], 404);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Erro ao salvar categoria.', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $categoria = $this->service->excluir($id);
            return response()->json([
                'data' => $categoria,
            ], 201);
        } catch (ModelNotFoundException $ex) {
            return response()->json(['error' => 'Categoria não encontrada.', 'details' => $ex->getMessage()], 500);
        }
    }
}
