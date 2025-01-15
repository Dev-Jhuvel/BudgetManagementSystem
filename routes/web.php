<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.landing');
});

Route::get('/register', [AuthController::class, 'registerPage'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'store']);

Route::get('/login', [AuthController::class, 'loginPage'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(middleware: 'auth');
Route::get('/dashboard/overview', [DashboardController::class, 'overview'])->name('dashboard.overview')->middleware(middleware: 'auth');

Route::resource('incomes', IncomeController::class)->middleware('auth');
Route::resource('expenses', ExpenseController::class)->middleware('auth');
Route::resource('categories', CategoryController::class)->only(['index', 'create', 'store', 'destroy'])->middleware('auth');
