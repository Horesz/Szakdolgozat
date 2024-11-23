<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Profil szerkesztés
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Főoldal útvonal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Kategória útvonalak
Route::get('/gaming-pc', [ProductController::class, 'gamingPc'])->name('category.gaming-pc');
Route::get('/peripherals', [ProductController::class, 'peripherals'])->name('category.peripherals');
Route::get('/components', [ProductController::class, 'components'])->name('category.components');
Route::get('/accessories', [ProductController::class, 'accessories'])->name('category.accessories');
Route::get('/category/games', [CategoryController::class, 'games'])->name('category.games');
Route::get('/category/consoles', [CategoryController::class, 'consoles'])->name('category.consoles');


// Egyéb útvonalak
Route::get('/deals', [ProductController::class, 'deals'])->name('deals');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/search', [ProductController::class, 'search'])->name('search');

// Authentikációs útvonalak
Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::get('/orders', [OrderController::class, 'index'])->name('orders')->middleware('auth');

// Hírlevél feliratkozás
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
require __DIR__.'/auth.php';
