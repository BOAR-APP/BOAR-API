<?php
// app/Http/Controllers/Api/AuthController.php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChangePasswordRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());

        // Création token Sanctum (sans abilities si tu passes aux rôles)
        $token = $user->createToken('api-token', expiresAt: now()->addDays(30))->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = $this->authService->login(
            $request->email,
            $request->password
        );

        // Création token (tu peux retirer les abilities si tu utilises des rôles)
        $token = $user->createToken('api-token', expiresAt: now()->addDays(30))->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
            'role' => $user->role,
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'user' => new UserResource($request->user()),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Déconnecté avec succès',
        ]);
    }

    public function updateMe(UserUpdateRequest $request): JsonResponse
    {
        $user = $request->user();
        $user->update($request->validated());

        return response()->json([
            'user' => new UserResource($user),
        ]);
    }

    public function deleteMe(Request $request): JsonResponse
    {
        $this->authService->deleteAccount($request->user());

        return response()->json(null, 204);
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $this->authService->changePassword(
            $request->user(),
            $request->current_password,
            $request->new_password
        );

        return response()->json([
            'message' => 'Mot de passe modifié avec succès',
        ]);
    }
}
