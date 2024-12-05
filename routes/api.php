<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceInformationController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiMiddleware;

Route::post('/users/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/users/reftoken', [AuthenticationController::class, 'refToken'])->name('reftoken');


Route::middleware(ApiMiddleware::class)->group(function () {
    Route::get('/users/profile', [ProfileController::class, 'getProfile'])->name('indexProfile');
    Route::post('/users/store-photo', [ProfileController::class, 'storePhotos'])->name('storePhotos');
    Route::post('/users/face-recognition', [ProfileController::class, 'faceRecognition'])->name('faceRecognition');
    Route::post('/users/validate-password', [ProfileController::class, 'validatePassword'])->name('validatePassword');
    Route::put('users/update-password', [ProfileController::class, 'changePassword'])->name('changePassword');
    Route::put('users/update-fcmId', [ProfileController::class, 'updateFcmId'])->name('updateFcmId');
    Route::get('/users/schedule-week', [ScheduleController::class, 'getScheduleForToday'])->name('getSchedule');
    Route::get('/users/schedule-date', [ScheduleController::class, 'getScheduleByDate'])->name('getScheduleByDate');
    Route::get('/users/schedule-id', [ScheduleController::class, 'getSchedule'])->name('getScheduleByID');
    Route::post('/users/store-attendance', [AttendanceController::class, 'attendance'])->name('storeAttendance');
    Route::post('/users/store-current-permit', [PermitController::class, 'storeCurrentPermit'])->name('storeCurrentPermit');
    Route::post('/users/store-before-schedule', [PermitController::class, 'permitBeforeSchedule'])->name('permitBeforeSchedule');
    Route::get('/users/history', [AttendanceController::class, 'historyAttendance'])->name('historyAttendance');
    Route::get('/users/history-week', [AttendanceController::class, 'getHistoryByWeek'])->name('HistoryByWeek');
    Route::get('/users/history-permit', [PermitController::class, 'getPermitHistory'])->name('permitHistory');
    Route::get('/users/attendance-information', [AttendanceInformationController::class, 'getAttendanceInformation'])->name('getAttendanceInformation');
});
