<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\User\Pay\UserController;

Route::get('/{token}', [UserController::class, 'pay']);
Route::get('/{token}/gateways/{gateway_id}', [UserController::class, 'transferInfo']);
