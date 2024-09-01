<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();


Route::get('/', [ProductController::class,'index'])->name('products.index');
Route::get('products/create', [ProductController::class,'create'])->name('products.create');

Route::Post('/products/store', [ProductController::class,'store'])->name('products.store');

Route::get('products/{id}/edit',[ProductController::class,'edit']);
Route::put('products/{id}/update',[ProductController::class,'update']);

Route::delete('products/{id}/delete',[ProductController::class,'destroy']);
Route::get('products/{id}/show',[ProductController::class,'show']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
