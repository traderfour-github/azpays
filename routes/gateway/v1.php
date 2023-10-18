<?php

use App\Http\Controllers\Gateway\GatewayController;
use Illuminate\Support\Facades\Route;

Route::prefix('gateways')->group(function(){
    Route::get('/', [GatewayController::class, 'get']);
    Route::post('/', [GatewayController::class, 'create']);
    Route::put('/{uuid}', [GatewayController::class, 'update']);
    Route::delete('/{uuid}', [GatewayController::class, 'delete']);
});
