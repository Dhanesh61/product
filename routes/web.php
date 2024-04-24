<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/admin','admin');
Route::get('index', [ProductController::class,'index'])->name('product.index');
Route::get('/create', [ProductController::class,'create'])->name('product.create');
Route::post('/product/store', [ProductController::class,'store'])->name('product.store');
Route::get('product/{id}', [ProductController::class,'edit'])->name('product.edit');
Route::post('product_update/{id}', [ProductController::class,'update']);
Route::delete('product_delete/{id}', [ProductController::class,'delete']);
