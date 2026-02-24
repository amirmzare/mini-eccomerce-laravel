<?php

use App\Http\Controllers\account\OrderController as AccountOrderController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class,'index'])->name('index');

Route::prefix('products')->controller(ProductController::class)->name('products.')->group(function (){

    Route::get('/','index')->name('index');
    Route::get('remove-filter','removeFilter')->name('remove-filter');
    Route::get('{product}','show')->name('show');

});

Route::prefix('account')->name('account.')->middleware('auth')->group(function () {

    Route::get('orders',[AccountOrderController::class,'index'])->name('orders');

    Route::prefix('edit-profile')->name('edit-profile.')->controller(EditProfileController::class)->group(function () {

        Route::get('/','index')->name('index');
        Route::post('/','post')->name('post');

    });

});

Route::prefix('cart')->name('cart.')->controller(OrderController::class)->middleware('auth')->group(function (){

    Route::get('/','index')->name('index');
    Route::post('add','add')->name('add');
    Route::get('clear','clear')->name('clear');
    Route::post('update-qty','updateQty')->name('update-qty');
    Route::get('{productId}/remove','removeItem')->name('remove-item');


});
