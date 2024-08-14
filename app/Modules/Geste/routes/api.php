<?php

use App\Modules\Geste\Http\Controllers\GesteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function PHPSTORM_META\map;


Route::prefix('api/geste')->group(function () {
    Route::get('/show', [GesteController::class, 'index']);
    Route::post('/add', [GesteController::class, 'add']);

} );