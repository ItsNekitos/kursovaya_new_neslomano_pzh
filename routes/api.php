<?php

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FileAccessController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('/registration', [UserController::class, "registration"]); //ok
Route::post('/authorization', [UserController::class, "authorization"]); //ok

Route::middleware('auth:sanctum')->group(function () {  
        Route::get('/logout', [UserController::class, "logout"]); //ok

        Route::post('/balance_create', [BalanceController::class, "balance_create"]); //ok

        Route::post('/category_create', [CategoryController::class, "category_create"]); //ok
    });
