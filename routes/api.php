<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')
        ->prefix('/v1')
        ->group(base_path('routes/api_v1.php'));

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
