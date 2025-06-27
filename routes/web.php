<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MealPlanController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Meal Plan / Menu Page (Interactive Display)
Route::get('/plans', [MealPlanController::class, 'index'])->name('plans.index');
Route::get('/plans/{id}', [MealPlanController::class, 'show'])->name('plans.show');