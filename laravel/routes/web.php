<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('auth/google', [App\Http\Controllers\AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [App\Http\Controllers\AuthController::class, 'handleGoogleCallback']);

Route::get('auth/github', [App\Http\Controllers\AuthController::class, 'redirectToGithub']);
Route::get('auth/github/callback', [App\Http\Controllers\AuthController::class, 'handleGithubCallback']);


Route::get('/', function () {
    return view('welcome');

});
