<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::middleware('auth:api')->group(function () {
    Route::prefix('/v1/product')
        ->controller(ProductController::class)
        ->group(function () {
            Route::post('/', 'store')->name('product.store');
        });
});

Route::prefix('/v1/auth')
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('/register', 'register')->name('auth.register');
    });

Route::fallback(function () {
    return response()->json(['message' => 'Access to this resource is forbidden.'], 403);
});
