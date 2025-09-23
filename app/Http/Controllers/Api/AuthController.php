<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\UsersRequest;
use App\Models\Users;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register',]]);
    }

    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $token = auth()->attempt([
            'ds_email' => $credentials['email'],
            'password' => $credentials['password'],
        ]);

        


        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'user' => auth()->user(),
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60,
            ]
        ]);
    }

    public function register(UsersRequest $request)
    {
        $user = Users::create([
            'ds_nome' => $request->ds_nome,
            'ds_email' => $request->ds_email,
            'ds_senha' => sha1($request->ds_senha),
        ]);

        $token = Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
