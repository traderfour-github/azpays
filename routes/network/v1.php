<?php

use App\Http\Controllers\Network\NetworkController;
use Illuminate\Support\Facades\Route;

Route::prefix('networks')->controller(NetworkController::class)->group(function () {
    Route::get('/', 'get');
    Route::get('/{uuid}', 'read');
    Route::post('/', 'create');
    Route::put('/{uuid}', 'update');
    Route::delete('/{uuid}', 'delete');
});
