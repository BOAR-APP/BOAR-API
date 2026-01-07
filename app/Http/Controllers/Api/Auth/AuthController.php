<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\ChangePasswordRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->safe()->except('password');

        $user = User::create([
            ...$validated,
            'password' => Hash::make($request->password),
            'verified' => false,
            'last_activity' => now(),
            'status' => 1,
        ]);


        $abilities = ['user'];
        $token = $user->createToken('api-token', $abilities, now()->addDays(30))->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants sont incorrects.'],
            ]);
        }

        $abilities = $user->status == 1 ? ['user'] : ['admin'];

        $token = $user->createToken('api-token', $abilities, now()->addDays(30))->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
            /** @var string[] */
            'abilities' => $abilities,
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'user' => new UserResource($request->user())
        ]);
    }
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Déconnecté avec succès'
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
        $request->user()->tokens()->delete();
        $user = $request->user();
        $user->delete();

        return response()->json(null, 204);
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = $request->user();
        if(!$user || !Hash::check($request->current_password, $user->password)){
            throw ValidationException::withMessages([
                'password' => ['Les mot de passe sont incorrects.'],
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json([
            "message" => "Mot de passe modifié avec succès"
        ]);
    }
}
