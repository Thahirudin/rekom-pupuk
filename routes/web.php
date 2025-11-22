<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::post('/login', [PageController::class, 'login'])->name('login');
Route::post('/signout', [UserController::class, 'signout'])->name('signout');

Route::get('/dashboard', function () {
    return view('admin/dashboard');
});

Route::middleware([UserMiddleware::class])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/edit/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{user}', [UserController::class, 'delete'])->name('user.delete');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/create', [ProductController::class, 'store'])->name('product.store');
    Route::get('product', [ProductController::class, 'index'])->name('product.index');
    Route::get('product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('product/edit/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/delete/{product}', [ProductController::class, 'delete'])->name('product.delete');
});
