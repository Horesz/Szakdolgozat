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

// ✅ Főoldal (csak 1 db legyen!)
Route::get('/', [HomeController::class, 'index'])->name('home');

// ✅ Kategóriák listázása (ha van CategoryController)
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/products', [ProductController::class, 'index'])->name('products');

// ✅ Publikus kategóriaoldalak (ProductController kezeli)
Route::get('/category/gaming-pc', [ProductController::class, 'gamingPc'])->name('category.gaming-pc');
Route::get('/category/peripherals', [ProductController::class, 'peripherals'])->name('category.peripherals');
Route::get('/category/components', [ProductController::class, 'components'])->name('category.components');
Route::get('/category/accessories', [ProductController::class, 'accessories'])->name('category.accessories');
Route::get('/category/games', [ProductController::class, 'games'])->name('category.games');
Route::get('/category/consoles', [ProductController::class, 'consoles'])->name('category.consoles');

// ✅ Akciós termékek
Route::get('/deals', [ProductController::class, 'deals'])->name('deals');

// ✅ Egyéb publikus oldalak
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/search', [ProductController::class, 'search'])->name('search');

// ✅ Hírlevél feliratkozás
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// ✅ Bejelentkezett felhasználói útvonalak
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Rendelések (csak bejelentkezett felhasználók)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
});

// ✅ Admin felület (csak admin felhasználóknak)
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});

// ✅ Autentikációs útvonalak (Laravel Breeze/Fortify)
require __DIR__.'/auth.php';
