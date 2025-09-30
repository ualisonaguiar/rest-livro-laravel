<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Services\UsuarioServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function __construct(private UsuarioServiceInterface $service) {}

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->service->listagem($request->query()));
    }

    public function store(UsuarioRequest $request): JsonResponse
    {
        try {
            return response()->json($this->service->store($request->validated()));
        } catch (\Exception $ex) {
            dd($ex);
        }
    }
}
