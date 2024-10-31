<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceInformationController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
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


Route::post('/users/login', [AuthenticationController::class, 'login'])->name('login')->name('login');


Route::middleware(ApiMiddleware::class)->group(function () {
    Route::get('/users/profile', [ProfileController::class, 'getProfile'])->name('indexProfile');
    Route::post('users/store-photo', [ProfileController::class, 'storePhotos'])->name('storePhotos');
    Route::put('users/update-password', [ProfileController::class, 'changePassword'])->name('changePassword');
    Route::get('/users/schedule-week', [ScheduleController::class, 'getScheduleForToday'])->name('getSchedule');
    Route::get('/users/schedule-date', [ScheduleController::class, 'getScheduleByDate'])->name('getScheduleByDate');
    Route::post('/users/store-attendance', [AttendanceController::class, 'attendance'])->name('storeAttendance');
    Route::post('/users/store-current-permit', [PermitController::class, 'storeCurrentPermit'])->name('storeCurrentPermit');
    Route::post('/users/store-before-schedule', [PermitController::class, 'permitBeforeSchedule'])->name('permitBeforeSchedule');
    Route::get('/users/history', [AttendanceController::class, 'historyAttendance'])->name('historyAttendance');
    Route::get('/users/history-permit', [PermitController::class, 'getPermitHistory'])->name('permitHistory');
    Route::get('/users/attendance-information', [AttendanceInformationController::class, 'getAttendanceInformation'])->name('getAttendanceInformation');
});
