<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use \Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function (){

    Route::middleware('guest')->group(function (){

        Route::prefix('login')->controller(LoginController::class)->name('login.')->group(function (){

            Route::get('/','index')->name('index');
            Route::post('/','post')->name('post');

        });

        Route::prefix('register')->controller(RegisterController::class)->name('register.')->group(function (){

            Route::get('/','index')->name('index');
            Route::post('/','post')->name('post');

        });

    });

    Route::get('logout',[LogoutController::class,'index'])->middleware('auth')->name('logout');

});
