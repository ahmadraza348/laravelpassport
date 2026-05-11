<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TodoController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::prefix('auth')
    ->controller(AuthController::class)
    ->group(function () {

        Route::post('/register', 'register');
        Route::post('/login', 'login');

        Route::middleware('auth:api')->group(function () {
        Route::get('/user-profile', 'userProfile');
        Route::get('/logout', 'logout');

        });
        Route::resource('todos', TodoController::class);


});