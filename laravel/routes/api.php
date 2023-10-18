<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [App\Http\Controllers\AuthController::class, 'Register']);
Route::post('login', [App\Http\Controllers\AuthController::class, 'Login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('getBlocks', [App\Http\Controllers\DbController::class, 'getUserBlocks']);
    Route::get('user', [App\Http\Controllers\AuthController::class, 'User']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'Logout']);
    Route::get('/test/{search}', [App\Http\Controllers\DbController::class, 'getData']);
});