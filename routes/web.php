<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BasketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [ProductController::class, 'index'])->name('product.index');

Route::post('/product', [ProductController::class, 'store'])->name('product.store');

Route::middleware('auth')->group(function() {
    Route::get('/my-basket', [BasketController::class, 'index'])->name('basket.index');
    Route::get('/my-orders', [BasketController::class, 'myOrders'])->name('basket.myOrders');
    Route::post('/add-to-basket', [BasketController::class, 'store'])->name('basket.store');
    Route::put('/confirm-purchase', [BasketController::class, 'confirm'])->name('basket.confirm');
    Route::delete('/basket/{productId}', [BasketController::class, 'destroy'])->name('basket.destroy');
    Route::get('/user/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');

    Route::middleware(['role:worker,admin'])->group(function() {
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::get('/product/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product/{id}/update', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/product/create', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('/orders', [BasketController::class, 'fulfillIndex'])->name('basket.fulfillIndex');
        Route::put('/orders/fulfill/{id}', [BasketController::class, 'fulfill'])->name('basket.fulfill');
    });

    Route::middleware(['role:admin'])->group(function() {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::put('/users/{id}/{newRole}', [UserController::class, 'changeRole'])->name('users.changeRole');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});


Auth::routes();
