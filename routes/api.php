<?php

use App\Http\Controllers\Api\UserController;
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


Route::prefix('s1')->group(function () {
    Route::post('/login', [UserController::class,'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user-profile',[UserController::class,'userProfile']); 
        Route::get('/logout',[UserController::class,'logout']);
    });
});