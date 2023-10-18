<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::middleware('auth.werify')->group(function(){
        include_once __DIR__ . '/gateway/v1.php';
        include_once __DIR__ . '/merchant/v1.php';
        include_once __DIR__ . '/network/v1.php';
        include_once __DIR__ . '/purse/v1.php';
        include_once __DIR__ . '/rate/v1.php';
        include_once __DIR__ . '/payment/v1.php';
        include_once __DIR__ . '/transaction/v1.php';
        include_once __DIR__ . '/discount/v1.php';
        include_once __DIR__ . '/subscription/v1.php';
        include_once __DIR__ . '/categories/v1.php';
        include_once __DIR__ . '/tags/v1.php';
    });
    Route::prefix('/pay')->group(function (){
        include_once __DIR__ . '/pay/v1.php';
    });
    Route::prefix('/crypto')->group(function (){
        include_once __DIR__ . '/crypto/tron.php';
    });
    Route::prefix('/webhooks')->group(function (){
        include_once __DIR__ . '/subscription/webhook.php';
    });
});
