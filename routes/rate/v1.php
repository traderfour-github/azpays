<?php

use App\Http\Controllers\Rate\RateController;
use Illuminate\Support\Facades\Route;

Route::prefix('rates')->controller(RateController::class)->group(function () {
    Route::get('/', 'get');
    Route::get('/{uuid}', 'read');
    Route::post('/', 'create');
    Route::put('/{uuid}', 'update');
    Route::delete('/{uuid}', 'delete');
});
