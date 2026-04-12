<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/home.php', 'home');

Route::view('/src/public/shop.php', 'src.public.shop');
Route::view('/src/public/product.php', 'src.public.product');

Route::middleware('guest')->group(function () {
    Route::get('/src/auth/login.php', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/src/auth/login.php', [AuthController::class, 'login']);
    Route::get('/src/auth/register.php', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/src/auth/register.php', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::view('/src/order/basket.php', 'src.order.basket');
Route::view('/src/order/basket-empty.php', 'src.order.basket-empty');
Route::view('/src/order/shipping.php', 'src.order.shipping');
Route::view('/src/order/payment.php', 'src.order.payment');
Route::view('/src/order/review.php', 'src.order.review');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::view('/src/admin/dashboard.php', 'src.admin.dashboard');
    Route::view('/src/admin/product-add.php', 'src.admin.product-add');
    Route::view('/src/admin/product-edit.php', 'src.admin.product-edit');
});
