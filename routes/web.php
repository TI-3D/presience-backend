<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/.well-known/assetlinks.json', function () {
    return response()->file(public_path('.well-known/assetlinks.json'));
});
Route::get('/app', function () {
    return response()->json(['status' => 'OK', 'message' => 'App Links Verified']);
});
