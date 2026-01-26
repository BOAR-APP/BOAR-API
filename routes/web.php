<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response()->json([
        'name' => 'BOAR API',
        'version' => '1.0.0',
        'environment' => config('app.env'),
        'documentation' => 'https://swagger-dev.boar-caen.fr',
    ]);
});
