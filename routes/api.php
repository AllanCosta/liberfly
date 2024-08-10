<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::post('register', [UserController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('authenticate')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [UserController::class, 'me']);
    Route::get('users', [UserController::class, 'index']);
});


Route::any('/{any}', function () {
    return response()->json(['message' => 'Invalid router'], 404);
})->where('any', '.*');
