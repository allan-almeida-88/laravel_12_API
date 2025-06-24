<?php

use App\Http\Controllers\PessoaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(PessoaController::class)->prefix('pessoa')->group(function() {
    Route::get('/', 'findAll');
    Route::get('/{id}', 'findById');
    Route::post('/', 'save');
    Route::put('/', 'update');
    Route::delete('/{id}', 'delete');
});