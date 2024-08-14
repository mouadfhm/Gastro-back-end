<?php

use App\Modules\Patient\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('patient')->group(function () {

Route::get('/show', [PatientController::class, 'index']);
Route::post('/add', [PatientController::class, 'add']);
Route::post('/update', [PatientController::class, 'update']);
Route::post('/delete', [PatientController::class, 'delete']);

    }
);