<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('login', 'AuthController@login')->name('login');

Route::fallback(function () {
    return response()->json(['message' => 'Access to this resource is forbidden.'], 403);
});