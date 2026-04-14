<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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

Route::middleware(['auth', 'admin'])->group(function () {
    Route::view('/src/admin/dashboard.php', 'src.admin.dashboard');
    Route::view('/src/admin/product-add.php', 'src.admin.product-add');
    Route::view('/src/admin/product-edit.php', 'src.admin.product-edit');
});
