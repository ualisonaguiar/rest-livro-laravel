<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UsersRequest;
use App\Models\Users;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function index(): JsonResponse
    {
        return response()->json(Users::all());
    }

    public function store(UsersRequest $request): JsonResponse
    {
        return response()->json($this->userService->create($request->validated()));
    }

    public function update(UpdateUserRequest $request, $id): JsonResponse
    {
        return response()->json($this->userService->update($id, $request->validated()));
    }

    public function delete($id): JsonResponse
    {
        return response()->json($this->userService->delete($id));
    }
}
