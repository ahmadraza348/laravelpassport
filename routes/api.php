<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TodoController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


// 1. Public Auth Routes
Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

// 2. Protected Routes (Requires Login)
Route::middleware('auth:api')->group(function () {
    
    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::get('/user-profile', 'userProfile');
        Route::post('/logout', 'logout');
    });

    Route::apiResource('todos', TodoController::class);
    
});