<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('/products',[ProductsController::class, 'index'])->name('product.index');

Route::get('/product/{product:slug}',[ProductsController::class, 'show'])->name('product.show');

Route::resource('cart', CartController::class);

require __DIR__.'/auth.php';


  require __DIR__.'/dashboard.php';
