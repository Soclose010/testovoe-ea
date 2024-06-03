<?php

use App\Http\Controllers\workController;
use Illuminate\Support\Facades\Route;

Route::get('/sales', [workController::class, "sales"]);
Route::get('/orders', [workController::class, "orders"]);
Route::get('/incomes', [workController::class, "incomes"]);
Route::get('/stocks', [workController::class, "stocks"]);
