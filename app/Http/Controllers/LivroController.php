<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Services\LivroServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function __construct(private LivroServiceInterface $service) {}

    public function index(Request $request): JsonResponse
    {
        //dd($filters = $request->all());

        return response()->json($this->service->listagem());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LivroRequest $request)
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
    public function edit(LivroRequest $request, $id)
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
