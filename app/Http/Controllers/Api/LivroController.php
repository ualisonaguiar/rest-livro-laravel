<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LivroRequest;
use App\Services\LivroServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function __construct(private LivroServiceInterface $service) {}

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->service->listagem($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LivroRequest $request): JsonResponse
    {
        try {
            $json = response()->json($this->service->store($request->validated()));
        } catch (\Exception $ex) {
            $json = $this->errorResponse('inserir', $ex, 404);
        }

        return $json;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $json = response()->json($this->service->getById($id));
        } catch (\Exception $ex) {
            $json = $this->errorResponse('buscar', $ex, 404);
        }

        return $json;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(LivroRequest $request, int $id): JsonResponse
    {
        try {
            $json = response()->json($this->service->update($request->validated(), $id));
        } catch (\Exception $ex) {
            $json = $this->errorResponse('atualizar', $ex, 404);
        }

        return $json;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $json = response()->json($this->service->delete($id));
        } catch (\Exception $ex) {
            $json = $this->errorResponse('excluir', $ex, 404);
        }

        return $json;
    }
}
