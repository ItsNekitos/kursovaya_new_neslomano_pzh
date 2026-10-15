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


Route::post('/registration', [UserController::class, "registration"]);
Route::post('/authorization', [UserController::class, "authorization"]);

Route::middleware('auth:sanctum')->group(function () {  
        Route::get('/logout', [UserController::class, "logout"]);

        Route::get('/balance_view/{balance_id}', [BalanceController::class, "balance_view"]); //просмотр баланса
        Route::post('/balance_create/{user}', [BalanceController::class, "balance_create"]); //создание баланса
        Route::delete('/balance_delete/{balance_id}', [BalanceController::class, "balance_delete"]); //удаление баланса

        Route::post('/category_create', [CategoryController::class, "category_create"]); //создание категории
        Route::get('/category_view/{category_id}', [CategoryController::class, "category_view"]); //просмотр категории
        Route::put('/category_update/{category_id}', [CategoryController::class, "category_update"]); //обновление категории
        Route::delete('/category_delete/{category_id}', [CategoryController::class, "category_delete"]); //удаление категории

        Route::post('/saving_create', [SavingController::class, "saving_create"]); //создание накопительного
        Route::get('/saving_view/{saving_id}', [SavingController::class, "saving_view"]); //просмотр накопительного
        Route::delete('/saving_delete/{saving_id}', [SavingController::class, "saving_delete"]); //удаление накопительного
        Route::put('/saving_update/{saving_id}', [SavingController::class, "saving_update"]); //обновление накопительного
        Route::post('/saving_popolneniye/{balance_id}/{saving_id}', [SavingController::class, "saving_popolneniye"]); //пополнение накопительного
        Route::post('/saving_vivod/{balance_id}/{saving_id}', [SavingController::class, "saving_vivod"]); //вывод с накопительного

        Route::post('/transaction_create/{category_id}/{balance_id}', [TransactionController::class, "transaction_create"]); //создание транзакции
        Route::get('/transaction_view/{transaction_id}', [TransactionController::class, "transaction_view"]); //просмотр транзакции
    });