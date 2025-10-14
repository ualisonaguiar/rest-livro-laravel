<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function errorResponse(string $action, \Exception $ex, int $status = 500): JsonResponse
    {
        return response()->json([
            'message' => "Erro ao realizar {$action}.",
            'error'   => $ex->getMessage(),
        ], $status);
    }
}
