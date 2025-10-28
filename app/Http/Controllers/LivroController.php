<?php

namespace App\Http\Controllers;

use App\Http\Resources\LivroResource;
use App\Services\LivroServiceInterface;

class LivroController extends Controller
{
    private LivroServiceInterface $service;

    public function __construct(LivroServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $livrosDb = $this->service->listagem([]);

        $livros = LivroResource::collection($livrosDb)->additional([
            '_links' => [
                'self' => $livrosDb->url($livrosDb->currentPage()),
                'first' => $livrosDb->url(1),
                'last' => $livrosDb->url($livrosDb->lastPage()),
                'prev' => $livrosDb->previousPageUrl(),
                'next' => $livrosDb->nextPageUrl(),
            ],
        ]);

        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        return view('livros.create');
    }
}
