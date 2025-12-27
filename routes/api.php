<?php

use Illuminate\Support\Facades\Route;


Route::apiResource('users', App\Http\Controllers\UserController::class);

Route::apiResource('reviews', App\Http\Controllers\ReviewController::class);

Route::apiResource('bars', App\Http\Controllers\BarController::class);

Route::apiResource('consumables', App\Http\Controllers\ConsumableController::class);

Route::apiResource('consumable-types', App\Http\Controllers\ConsumableTypeController::class);

Route::apiResource('recommendations', App\Http\Controllers\RecommendationController::class);
