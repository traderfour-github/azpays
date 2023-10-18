<?php

use App\Http\Controllers\V1\User\Subscription\WebhookController;
use Illuminate\Support\Facades\Route;

Route::prefix('subscription')->group(function () {
    Route::post('/', [WebhookController::class, 'info']);
});
