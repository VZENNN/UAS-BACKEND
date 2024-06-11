<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    // Shop
    Route::controller(ShopController::class)->group(function() {
        Route::post('/shop/create', 'create')->name('shopCreate');
        Route::get('/shop/detail', 'detail')->name('shopDetail');
        Route::post('/shop/update', 'update')->name('shopUpdate');
        Route::post('/shop/update-password', 'updatePassword')->name('shopUpdatePassword');
    });

    // Category
    Route::controller(CategoryController::class)->group(function() {
        Route::get('/admin/category', 'index')->name('category');
        Route::get('/admin/category/create', 'create')->name('categoryCreate');
        Route::post('/admin/category/check', 'check')->name('categoryCheck');
        Route::post('/admin/category/save', 'save')->name('categorySave');
        Route::get('/admin/category/delete/{id}/{path}', 'delete')->name('categoryDelete');
    });

    // Product
    Route::controller(ProductController::class)->group(function() {
        Route::get('/admin/products', 'index')->name('products');
        Route::get('/admin/product/create', 'create')->name('productCreate');
        Route::post('/admin/product/check', 'check')->name('productCheck');
        Route::post('/admin/product/save', 'save')->name('producSave');
        Route::post('/admin/product/images/', 'getImages')->name('productGetImages');
        Route::get('/admin/product/images/{product}', 'addImages')->name('productAddImages');
        Route::post('/admin/product/images/save', 'addImagesSave')->name('productAddImagesSave');
        Route::post('/admin/product/images/delete', 'deleteImages')->name('productDeleteImages');
        Route::get('/admin/product/edit/{product}', 'edit')->name('productEdit');
        Route::post('/admin/product/edit/{product}/{id}/save', 'editSave')->name('productEditSave');
        Route::get('/admin/product/delete/{id}', 'delete')->name('productDelete');
    });

    // Orders
    Route::controller(OrderController::class)->group(function() {
        Route::get('/admin/orders', 'index')->name('orders');
        Route::get('/admin/order/{order_code}', 'detail')->name('orderDetail');
        Route::post('/admin/order/update-status/{order_code}', 'updateStatus')->name('orderUpdateStatus');
        Route::get('/admin/order/delete/{order_code}', 'delete')->name('orderDelete');
    });
});
