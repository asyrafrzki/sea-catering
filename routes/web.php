<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\DashboardController; // ✅ Dashboard

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===============================
// Home Page
// ===============================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ===============================
// Auth Routes
// ===============================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ===============================
// Meal Plan / Menu Routes
// ===============================
Route::get('/plans', [MealPlanController::class, 'index'])->name('plans.index');
Route::get('/plans/{id}', [MealPlanController::class, 'show'])->name('plans.show');

// ===============================
// Subscription Routes (Level 3)
// ===============================
Route::middleware(['auth'])->group(function () {

    // Create & Store Subscription
    Route::get('/subscription', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::post('/subscription', [SubscriptionController::class, 'store'])->name('subscription.store');

    // User's subscriptions
    Route::get('/my-subscriptions', [SubscriptionController::class, 'index'])->name('subscription.index');

    //  User Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //  Dashboard actions: Pause, Resume, Cancel
    Route::post('/dashboard/{subscription}/pause', [DashboardController::class, 'pause'])->name('dashboard.pause');
    Route::post('/dashboard/{subscription}/resume', [DashboardController::class, 'resume'])->name('dashboard.resume');
    Route::post('/dashboard/{subscription}/cancel', [DashboardController::class, 'cancel'])->name('dashboard.cancel');
});

// ===============================
// Testimonial Routes
// ===============================
Route::post('/testimonial', [TestimonialController::class, 'store'])
    ->middleware('auth')
    ->name('testimonial.store');
