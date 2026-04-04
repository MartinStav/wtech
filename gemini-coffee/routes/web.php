<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/home.php', 'home');

Route::view('/src/public/shop.php', 'src.public.shop');
Route::view('/src/public/product.php', 'src.public.product');

Route::view('/src/auth/login.php', 'src.auth.login');
Route::view('/src/auth/register.php', 'src.auth.register');

Route::view('/src/order/basket.php', 'src.order.basket');
Route::view('/src/order/basket-empty.php', 'src.order.basket-empty');
Route::view('/src/order/shipping.php', 'src.order.shipping');
Route::view('/src/order/payment.php', 'src.order.payment');
Route::view('/src/order/review.php', 'src.order.review');

Route::view('/src/admin/dashboard.php', 'src.admin.dashboard');
Route::view('/src/admin/product-add.php', 'src.admin.product-add');
Route::view('/src/admin/product-edit.php', 'src.admin.product-edit');
