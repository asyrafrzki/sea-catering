<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TestimonialController; // ✅ Tambahkan controller testimonial

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

// ===============================
// Subscription Routes (Level 3)
// ===============================
Route::middleware(['auth'])->group(function () {
    // Show subscription form
    Route::get('/subscription', [SubscriptionController::class, 'create'])->name('subscription.create');

    // Handle form submission
    Route::post('/subscription', [SubscriptionController::class, 'store'])->name('subscription.store');

    // Show user's subscriptions
    Route::get('/my-subscriptions', [SubscriptionController::class, 'index'])->name('subscription.index');
});

// ===============================
// Testimonial Routes (Tambahan)
// ===============================
Route::post('/testimonial', [TestimonialController::class, 'store'])->middleware('auth')->name('testimonial.store');



