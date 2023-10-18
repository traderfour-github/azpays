<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\User\Purse\UserController;


Route::prefix('purses')->group(function () {
    Route::get('/', [UserController::class, 'get']);
    Route::post('/', [UserController::class, 'create']);
    Route::get('/{uuid}', [UserController::class, 'read']);
    Route::put('/{uuid}', [UserController::class, 'update']);
    Route::delete('/{uuid}', [UserController::class, 'delete']);
    Route::post('/add-user', [UserController::class, 'addUser']);
    Route::put('/{uuid}/update-user', [UserController::class, 'updateUser']);
    Route::delete('/{uuid}/delete-user', [UserController::class, 'deleteUser']);
});

