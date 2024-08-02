<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::fallback(function () {
    return response()->json(['message' => 'Access to this resource is forbidden.'], 403);
});