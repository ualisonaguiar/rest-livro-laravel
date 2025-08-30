<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use App\Services\LivroServiceInterface;
use Illuminate\Http\JsonResponse;

class LivroController extends Controller
{
    public function __construct(private LivroServiceInterface $service) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->listagem());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLivroRequest $request)
    {
        return response()->json($this->service->store($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json($this->service->getById($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UpdateLivroRequest $request, $id)
    {
        return response()->json($this->service->update($request->validated(), $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json($this->service->delete($id));
    }
}
