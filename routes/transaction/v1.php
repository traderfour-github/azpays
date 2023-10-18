<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\User\Transactions\UserController;

Route::prefix('transactions')->group(function(){
    Route::get('/', [UserController::class, 'get']);
    Route::get('/{uuid}', [UserController::class, 'read']);
});
