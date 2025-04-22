<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('blogs', BlogController::class);
    Route::get('user', function (Request $request) {
        return $request->user();
    })->name('user');
});
