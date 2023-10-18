<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\User\Subscription\UserController;

Route::prefix('subscription')->group(function () {
    Route::post('/', [UserController::class, 'store']);
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{subscription}', [UserController::class, 'show']);
    Route::put('/{subscription}', [UserController::class, 'update']);
    Route::delete('/{subscription}', [UserController::class, 'destroy']);
});
