<?php

use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class,'index'])->name('index');

Route::prefix('products')->controller(ProductController::class)->name('products.')->group(function (){

    Route::get('/','index')->name('index');
    Route::get('{product}','show')->name('show');

});

Route::prefix('account')->name('account.')->middleware('auth')->group(function () {

    Route::get('orders',[OrderController::class,'index'])->name('orders');

    Route::prefix('edit-profile')->name('edit-profile.')->controller(EditProfileController::class)->group(function () {

        Route::get('/','index')->name('index');
        Route::post('/','post')->name('post');

    });

});
