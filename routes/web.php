<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/app/.well-known/assetlinks.json', function () {
    return response()->file(public_path('.well-known/assetlinks.json'));
});
