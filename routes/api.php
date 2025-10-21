<?php

use App\Http\Controllers\API\RFIDController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/rfid/login', [RFIDController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/rfid/scan', [RFIDController::class, 'scan']);
});