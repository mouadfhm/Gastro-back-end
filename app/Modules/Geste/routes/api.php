<?php

use App\Modules\Geste\Http\Controllers\GesteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('geste')->group(function () {
    Route::get('/show', [GesteController::class, 'index']);
    Route::post('/add', [GesteController::class, 'add']);
    Route::post('/update', [GesteController::class, 'update']);
    Route::post('/delete', [GesteController::class, 'delete']);
});
