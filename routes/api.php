<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::get('/', function () {
    return Response::json(array(
            'success' => true,
            'data' => Array('Hello World'),
            'errors' => [],
        ));
});

Route::get('products', function () {
    
    $products = new App\Api\ProductController;
    
    return $products->getProducts();
});

Route::get('product/{uuid?}', function ($uuid=null) {
    
    $products = new App\Api\ProductController;
    
    return $products->getProduct($uuid);
});

Route::get('cart/count/{token}', function ($token) {
    
    $products = new App\Api\CartController;
    
    return $products->countCartItems($token);
});

Route::post('cart/upadte/{token}', function ($token) {
    
    $products = new App\Api\CartController;
    
    return $products->updateCart($token);
});

Route::post('/cart/delete/{token}', function ($token) {
    $product = new App\Api\CartController;
    return $product->deleteCartItem($token);
});

Route::post('/cart/buy/{token}', function ($token) {
    $product = new App\Api\CartController;
    return $product->buyCart($token);
});