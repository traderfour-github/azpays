<?php

use App\Http\Controllers\Crypto\Tron\AddressController;
use App\Http\Controllers\Crypto\Tron\ContractController;
use App\Http\Controllers\Crypto\Tron\EventController;
use App\Http\Controllers\Crypto\Tron\TransactionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'tron'], function () {
    Route::group(['prefix' => 'addresses'], function () {
        Route::get('generate', [AddressController::class, 'generate']);
        Route::get('{address}/verify', [AddressController::class, 'verify']);
        Route::get('{address}/info', [AddressController::class, 'info']);
        Route::get('{address}/transactions', [AddressController::class, 'transactions']);
    });

    Route::group(['prefix'=>'contracts'], function(){
        Route::get('{contractAddress}/transactions', [ContractController::class, 'transactions']);
    });

    Route::group(['prefix'=>'events'], function(){
        Route::get('{transactionID}', [EventController::class, 'transactions']);
    });

    Route::group(['prefix'=>'transactions'], function(){
        Route::get('{transactionID}', [TransactionController::class, 'read']);
        Route::get('{transactionID}/info', [TransactionController::class, 'info']);
        Route::get('{transactionHash}/check', [TransactionController::class, 'check']);
    });
});
