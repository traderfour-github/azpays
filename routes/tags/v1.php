<?php

use \App\Http\Controllers\Tag\TagController;
use Illuminate\Support\Facades\Route;

Route::prefix('tags')->group(function(){
    Route::get('/', [TagController::class, 'get']);
    Route::get('/{uuid}', [TagController::class, 'read']);
});
