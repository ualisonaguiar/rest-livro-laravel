<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function index():JsonResponse {
        return response()->json(User::all());
    }

    public function store(StoreUserRequest $request): JsonResponse {
        return response()->json($this->userService->create($request->validated()));
    }

    public function update(UpdateUserRequest $request, $id): JsonResponse {
        return response()->json($this->userService->update($id, $request->validated()));
    }

    public function delete($id): JsonResponse {
        return response()->json($this->userService->delete($id));
    }
}
