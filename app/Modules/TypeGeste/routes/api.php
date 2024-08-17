<?php

use App\Modules\TypeGeste\Http\Controllers\TypeGesteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('type-geste')->group(
    function () {
        Route::get('/show', [TypeGesteController::class, 'index']);
    }
);
