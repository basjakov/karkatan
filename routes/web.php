<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\VacanciesController;

    Route::get('lang/{locale}', [LocalizationController::class,'index'])->name('lang');

    Route::get('/',[PagesController::class,'Home'])->name('home');

    Route::get('/makeaccount',[AccountController::class,'create'])->name('makeaccount');
    Route::post('/makeaccount',[AccountController::class,'store'])->name('storeaccount');

    Route::get('/dashboard/profile/{id}',[AccountController::class,'show'])->name('userprofile.show');

    Route::prefix('/dashboard')->middleware(['auth', 'auth'])->group(function () {
        Route::resource('/product', ProductController::class);
        Route::delete('/product/imagedestroy/{id}',[ProductController::class,'DestroyImage'])->name('product.destroyimage');
        Route::get('/order/create/{profile_id}',[OrderController::class,'create'])->name('order.create');
        Route::post('/order/create',[OrderController::class,'sendOffer'])->name('order.offer');
        Route::post('/order/acceptoffer/{id}',[OrderController::class,'acceptOffer'])->name('order.acceptOffer');
        Route::delete('/order/rejectoffer/{id}',[OrderController::class,'rejectOffer'])->name('order.reject');
        Route::post('/order/finishtask/{id}',[OrderController::class,'finishtask'])->name('order.finishtask');
        Route::post('/order/delivery/{id}',[OrderController::class,'delivery'])->name('order.delivery');
        Route::post('/order/completed/{id}',[OrderController::class,'completed'])->name('order.completed');
        Route::post('/order/canceled/{id}',[OrderController::class,'canceled'])->name('order.canceled');
    });

    Route::get('/terms',[TermsController::class,'show'])->name('terms');
    Route::get('/vacancies',[VacanciesController::class,'index'])->name('vacancies');

    Route::get('/products',[PagesController::class,'Products'])->name('products');
    Route::get('/experts',[PagesController::class,'Experts'])->name('experts');
    Route::get('/@{username}',[PagesController::class,'ShowExpert'])->name('expert.show');


    Route::get('/product/{id}/{name}',[PagesController::class,'ShowProduct'])->name('product.show');

    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard',[AccountController::class,'Dashboard'])->name('dashboard');

    Route::get('/logout', function(){
        Auth::logout();
        return Redirect('/login');
    })->name('logout');
