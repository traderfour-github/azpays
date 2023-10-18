<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Discount\DiscountController;

Route::prefix('discount')->group(function () {
    Route::get('/', [DiscountController::class, 'index']);
    Route::post('/', [DiscountController::class, 'store']);
    Route::get('/{discount}', [DiscountController::class, 'show']);
    Route::put('/{discount}', [DiscountController::class, 'update']);
    Route::delete('/{discount}', [DiscountController::class, 'destroy']);
    Route::post('/verify', [DiscountController::class, 'verify']);
});
