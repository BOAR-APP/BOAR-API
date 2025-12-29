<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
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

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
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
            'abilities' => $abilities,
        ]);
    }
}
