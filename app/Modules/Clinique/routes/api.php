<?php

use App\Modules\Clinique\Http\Controllers\CliniqueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('clinique')->group(function () {
    Route::get('/show', [CliniqueController::class, 'index']);
    Route::post('/add', [CliniqueController::class, 'add']);
    Route::post('/delete', [CliniqueController::class, 'delete']);

} );