<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiMiddleware;

// Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
//     // Route::post('login', [AuthController::class, 'login']); (contoh login)

//     Route::group(['middleware' => ApiMiddleware::class], function () {
//         // Route::post('logout', [AuthController::class, 'logout']); (contoh logout)
//     });
// });


Route::post('/users/login', [\App\Http\Controllers\AuthenticationController::class, 'login'])->name('login')->name('login');
Route::middleware(\App\Http\Middleware\ApiMiddleware::class)->group(function () {
    Route::get('/users/current', [\App\Http\Controllers\AuthenticationController::class, 'get']);
});

