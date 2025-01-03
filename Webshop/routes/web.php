<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;

// Főoldal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Publikus útvonalak
Route::get('/gaming-pc', [ProductController::class, 'gamingPc'])->name('category.gaming-pc');
Route::get('/peripherals', [ProductController::class, 'peripherals'])->name('category.peripherals');
Route::get('/components', [ProductController::class, 'components'])->name('category.components');
Route::get('/accessories', [ProductController::class, 'accessories'])->name('category.accessories');
Route::get('/category/games', [CategoryController::class, 'games'])->name('category.games');
Route::get('/category/consoles', [CategoryController::class, 'consoles'])->name('category.consoles');
Route::get('/deals', [ProductController::class, 'deals'])->name('deals');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Bejelentkezett felhasználói útvonalak
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
});

// Admin útvonalak
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    // Termék kezelés
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    // Felhasználó kezelés
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.users.index');
        Route::get('/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{user}', [AdminController::class, 'update'])->name('admin.users.update');
        Route::delete('/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    });
});

// Auth routes
require __DIR__.'/auth.php';