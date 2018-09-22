<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $products = new App\Http\Controllers\ProductController;
    return $products->showProducts();
});

Route::get('/products', function () {
    $products = new App\Http\Controllers\ProductController;
    return $products->showProducts();
});

Route::get('/product/{uuid}', function ($uuid) {
    $product = new App\Http\Controllers\ProductController;
    return $product->showProduct($uuid);
});

Route::get('/cart', function () {
    $product = new App\Http\Controllers\CartController;
    return $product->showCart();
});