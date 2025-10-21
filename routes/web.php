<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('login', [AuthController::class, 'login'])->name('auth.login');

Route::get('dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');