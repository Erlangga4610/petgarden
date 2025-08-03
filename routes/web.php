<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TestimonialController;


Route::get('/', [ProductController::class, 'index']);

Route::resource('/products', ProductController::class);

// auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/testimoni', [TestimonialController::class, 'index'])->name('testimonials.index');
// Route::post('/testimoni', [TestimonialController::class, 'store'])->name('testimonials.store');
Route::resource('testimonials', \App\Http\Controllers\TestimonialController::class);
