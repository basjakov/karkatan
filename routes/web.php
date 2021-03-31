<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\OrderController;

    Route::get('lang/{locale}', [LocalizationController::class,'index']);

    Route::get('/',[PagesController::class,'Home'])->name('home');

    Route::get('/makeaccount',[AccountController::class,'create'])->name('makeaccount');
    Route::post('/makeaccount',[AccountController::class,'store'])->name('storeaccount');

    Route::get('/dashboard/profile/{id}',[AccountController::class,'show'])->name('userprofile.show');

    Route::prefix('/dashboard')->middleware(['auth', 'auth'])->group(function () {
        Route::resource('/product', ProductController::class);
        Route::delete('/product/imagedestroy/{id}',[ProductController::class,'DestroyImage'])->name('product.destroyimage');
        Route::get('/order/create/{profile_id}',[OrderController::class,'create'])->name('order.create');
        Route::post('/order/create',[OrderController::class,'sendOffer'])->name('order.offer');
    });


    Route::get('/products',[PagesController::class,'Products'])->name('products');
    Route::get('/experts',[PagesController::class,'Experts'])->name('experts');
    Route::get('/@{username}',[PagesController::class,'ShowExpert'])->name('expert.show');


    Route::get('/product/{id}/{name}',[PagesController::class,'ShowProduct'])->name('product.show');

    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard',[AccountController::class,'Dashboard'])->name('dashboard');

    Route::get('/logout', function(){
        Auth::logout();
        return Redirect('/login');
    })->name('logout');
