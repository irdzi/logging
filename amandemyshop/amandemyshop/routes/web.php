<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product', [ProductController::class, 'index'])->name('product.index');

Route::get('/admin/list-product', [ProductController::class, 'show'])->name('list-product.show');

Route::get('/form', [FormController::class, 'index'])->name('form.index');

Route::get('/tambah-produk', [ProductController::class, 'create'])->name('product.create');

Route::post('/admin/list-product', [ProductController::class, 'store'])->name('product.store');

Route::get('/form/{id}', [ProductController::class, 'edit'])->name('product.edit');

Route::put('/form/{id}', [ProductController::class, 'update'])->name('product.update');

Route::delete('/admin/list-product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/list-product/{id}', [ProductController::class, 'listProductByUser'])->name('list-product-by-user');

Route::get('/{id}/tambah_product', [ProductController::class, 'create'])->name('product.create');

Route::post('/admin/list-product/{id}', [ProductController::class, 'store'])->name('product.store');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

