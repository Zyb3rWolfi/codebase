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

Route::middleware(['throttle:20,1']) ->group(function () {
    Route::post('register', [App\Http\Controllers\AuthController::class, 'newRegister']);
    Route::post('login', [App\Http\Controllers\AuthController::class, 'newLogin']);
});

Route::get('/getSharedBlock/{token}', [App\Http\Controllers\DbController::class,'getSharedBlock']);
Route::post('/createShareToken', [App\Http\Controllers\DbController::class, 'createShareToken']);
Route::middleware('auth:api')->group(function () {
    Route::post('deleteAccount', [App\Http\Controllers\AuthController::class, 'deleteAccount']);
    Route::post('adminDeleteAccount', [App\Http\Controllers\AuthController::class, 'adminDeleteAccount']);
    Route::post('getUserByID', [App\Http\Controllers\DbController::class, 'getUserDetailsByID']);
    Route::post('getUserPreviews', [App\Http\Controllers\DbController::class, 'GetUserPreviews']);
    Route::get('userCount', [App\Http\Controllers\DbController::class, 'getUserCount']);
    Route::get('newUserCount', [App\Http\Controllers\DbController::class, 'getNewUserCount']);
    Route::get('user', [App\Http\Controllers\AuthController::class, 'User']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'Logout']);
    Route::post('getBlocks', [App\Http\Controllers\DbController::class, 'getUserBlocks']);
    Route::post('changedetails', [App\Http\Controllers\AuthController::class, 'changeDetails']);
    Route::post('changePassword', [App\Http\Controllers\AuthController::class, 'changePassword']);
    Route::post('/test', [App\Http\Controllers\DbController::class, 'getData']);
    
    // Oauth routes
    Route::post('addPassword', [App\Http\Controllers\AuthController::class, 'addPassword']);
    Route::post('removeGithub', [App\Http\Controllers\AuthController::class, 'removeGithub']);
    Route::post('removeGoogle', [App\Http\Controllers\AuthController::class, 'removeGoogle']);
    Route::get('passwordNull', [App\Http\Controllers\AuthController::class, 'passwordNull']);
    Route::post('removePassword' , [App\Http\Controllers\AuthController::class, 'removePassword']);
    Route::get('getConnections', [App\Http\Controllers\AuthController::class, 'getConnections']);
    
    Route::middleware(['throttle:10,1']) ->group(function () {
        Route::post('/addBlock', [App\Http\Controllers\DbController::class, 'addBlock']);
        Route::post('/deleteBlock', [App\Http\Controllers\DbController::class, 'deleteBlock']);
        Route::post('/updateBlock', [App\Http\Controllers\DbController::class, 'updateBlock']);
    });
});