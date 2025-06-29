<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Meal Plans
Route::get('/plans', [MealPlanController::class, 'index'])->name('plans.index');
Route::get('/plans/{id}', [MealPlanController::class, 'show'])->name('plans.show');

// Subscription (User)
Route::middleware(['auth'])->group(function () {
    Route::get('/subscription', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::post('/subscription', [SubscriptionController::class, 'store'])->name('subscription.store');
    Route::get('/my-subscriptions', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/{subscription}/pause', [DashboardController::class, 'pause'])->name('dashboard.pause');
    Route::post('/dashboard/{subscription}/resume', [DashboardController::class, 'resume'])->name('dashboard.resume');
    Route::post('/dashboard/{subscription}/cancel', [DashboardController::class, 'cancel'])->name('dashboard.cancel');
});

// Admin Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/users/{user}', [AdminDashboardController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/users/{user}/subscriptions', [AdminDashboardController::class, 'viewUserSubscriptions'])->name('admin.users.subscriptions');
});

// Testimonial
Route::post('/testimonial', [TestimonialController::class, 'store'])
    ->middleware('auth')
    ->name('testimonial.store');
