<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);
Route::get('/home.php', HomeController::class);

Route::get('/src/public/shop.php', [ShopController::class, 'index'])->name('shop');
Route::get('/src/public/product.php', [ShopController::class, 'show'])->name('product.show');

Route::middleware('guest')->group(function () {
    Route::get('/src/auth/login.php', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/src/auth/login.php', [AuthController::class, 'login']);
    Route::get('/src/auth/register.php', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/src/auth/register.php', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/src/profile.php', [FavoriteController::class, 'profile'])->name('profile');
    Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
});

Route::get('/src/order/basket.php', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/src/order/basket-empty.php', fn () => redirect()->route('cart.index'));

Route::get('/src/order/shipping.php', [CheckoutController::class, 'showShipping']);
Route::post('/src/order/shipping.php', [CheckoutController::class, 'storeShipping']);
Route::get('/src/order/payment.php', [CheckoutController::class, 'showPayment']);
Route::post('/src/order/payment.php', [CheckoutController::class, 'storePayment']);
Route::get('/src/order/review.php', [CheckoutController::class, 'showReview']);
Route::post('/src/order/complete.php', [CheckoutController::class, 'completeOrder'])->name('checkout.complete');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/src/admin/dashboard.php', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/src/admin/product-add.php', [AdminController::class, 'create'])->name('admin.product.create');
    Route::post('/src/admin/product-add.php', [AdminController::class, 'store'])->name('admin.product.store');
    Route::get('/src/admin/product-edit.php', [AdminController::class, 'edit'])->name('admin.product.edit');
    Route::post('/src/admin/product-edit.php', [AdminController::class, 'update'])->name('admin.product.update');
    Route::post('/src/admin/product-delete.php', [AdminController::class, 'destroy'])->name('admin.product.destroy');
});
