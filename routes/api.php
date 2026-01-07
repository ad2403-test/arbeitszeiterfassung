<?php

use App\Http\Controllers\API\RFIDController;
use App\Http\Middleware\EnsureDeviceIsRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware([EnsureDeviceIsRegistered::class])->group(function () {
    Route::post('/rfid/scan', [RFIDController::class, 'scan']);
});