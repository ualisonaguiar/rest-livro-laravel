<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as BaseExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ExceptionHandler extends BaseExceptionHandler
{
    /**
     * Registra os manipuladores de exceção personalizados.
     */
    public function register(): void
    {
        // Model não encontrada
        $this->renderable(function (ModelNotFoundException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Recurso não encontrado.',
                ], 404);
            }
        });

        // Rota inexistente
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Rota não encontrada.',
                ], 404);
            }
        });

        // Erros gerais (500)
        $this->renderable(function (Throwable $e, $request) {
            if ($request->expectsJson() && !($e instanceof NotFoundHttpException) && !($e instanceof ModelNotFoundException)) {
                return response()->json([
                    'error' => 'Erro interno no servidor.',
                    'message' => config('app.debug') ? $e->getMessage() : null,
                ], 500);
            }
        });
    }
}
