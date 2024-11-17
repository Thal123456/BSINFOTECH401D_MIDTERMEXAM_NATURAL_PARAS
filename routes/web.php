<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('landing');
});
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/product', [ProductController::class, 'store'])->name('products.store');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/product/{product}', [ProductController::class, 'update'])->name('products.update');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('products.show');
Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/product', [ProductController::class, 'index'])->name('products.index');
