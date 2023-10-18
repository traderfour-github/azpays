<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\User\Payments\UserController;

Route::prefix('payments')->group(function(){
    Route::get('/', [UserController::class, 'get']);
    Route::post('/', [UserController::class, 'create']);
    Route::get('/{id}', [UserController::class, 'read']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'delete']);
});
