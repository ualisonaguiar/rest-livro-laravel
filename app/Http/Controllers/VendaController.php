<?php

namespace App\Http\Controllers;

use App\Services\VendaServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function __construct(private VendaServiceInterface $service) {}

    public function listagem(Request $request): JsonResponse
    {
        return response()->json($this->service->listagem($request->query()));
    }
}
