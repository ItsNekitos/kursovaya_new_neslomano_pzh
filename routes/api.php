<?php

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FileAccessController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LimitController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\TransactionController;
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

        Route::post('/saving_create', [SavingController::class, "saving_create"]); //ok

        Route::post('/limit_create/{balance_id}/{category_id}', [LimitController::class, "limit_create"]); //ok
        Route::delete('/limit_delete/{balance_id}/{category_id}', [LimitController::class, "limit_delete"]); //ok

        Route::post('/transaction_create/{category_id}/{balance_id}', [TransactionController::class, "transaction_create"]); //ok
    });
