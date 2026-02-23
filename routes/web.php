<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class,'index'])->name('index');

Route::prefix('products')->controller(ProductController::class)->name('products.')->group(function (){

    Route::get('/','index')->name('index');
    Route::get('{product}','show')->name('show');

});
