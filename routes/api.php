<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| AUTH PUBLIC ROUTES (RATE LIMITED)
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->controller(AuthController::class)->group(function () {

    // prevent brute force / spam registration
    Route::post('/register', 'register')
        ->middleware('throttle:10,1');

    // login must be STRICT (security critical)
    Route::post('/login', 'login')
        ->middleware('throttle:3,1');
});

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (AUTH + RATE LIMIT)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api', 'throttle:api'])->group(function () {

    /*
    |-----------------------------
    | AUTH USER ACTIONS
    |-----------------------------
    */
    Route::prefix('auth')->controller(AuthController::class)->group(function () {

        Route::get('/user-profile', 'userProfile');

        Route::post('/logout', 'logout');
    });

    /*
    |-----------------------------
    | TODO CRUD (RATE LIMITED)
    |-----------------------------
    */
    Route::apiResource('todos', TodoController::class);
});