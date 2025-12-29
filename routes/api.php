<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\BarController;
use App\Http\Controllers\Api\ConsumableController;
use App\Http\Controllers\Api\RecommendationController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


//route public
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//outes public des bars
Route::get('bars',  [BarController::class, 'index']);
Route::get('bars/{bar}', [BarController::class, 'show']);

Route::get('reviews', [ReviewController::class, 'index']);
Route::get('reviews/{review}', [ReviewController::class, 'show']);

Route::get('consumables', [ConsumableController::class, 'index']);
Route::get('consumables/{consumable}', [ConsumableController::class, 'show']);

Route::get('recommendations', [RecommendationController::class, 'index']);
Route::get('recommendations/{recommendation}', [RecommendationController::class, 'show']);

//route propre à un user
Route::middleware(['auth:sanctum', 'ability:user,admin'])->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::patch('me',  [AuthController::class, 'updateMe']);
    Route::delete('me',  [AuthController::class, 'deleteMe']);

    Route::post('logout', [AuthController::class, 'logout']);
});
/*
Route::apiResource('users', App\Http\Controllers\UserController::class);

Route::apiResource('reviews', App\Http\Controllers\ReviewController::class);

Route::apiResource('bars', App\Http\Controllers\BarController::class);

Route::apiResource('consumables', App\Http\Controllers\ConsumableController::class);

Route::apiResource('consumable-types', App\Http\Controllers\ConsumableTypeController::class);

Route::apiResource('recommendations', App\Http\Controllers\RecommendationController::class);
*/
