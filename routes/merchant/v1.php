<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Business\MerchantController;

Route::prefix('merchants')->controller(MerchantController::class)->group(function() {
    Route::get('/', 'get');
    Route::post('/', 'create');
    Route::get('/{uuid}', 'read');
    Route::put('/{uuid}', 'update');
    Route::delete('/{uuid}', 'delete');
    Route::get('/{uuid}/transactions', 'transactions');
    Route::get('/{uuid}/payments', 'payments');
});
