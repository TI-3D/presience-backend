<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiMiddleware;

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    // Route::post('login', [AuthController::class, 'login']); (contoh login)

    Route::group(['middleware' => ApiMiddleware::class], function () {
        // Route::post('logout', [AuthController::class, 'logout']); (contoh logout)
    });
});
