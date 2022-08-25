<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminRegistrationController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admins/login', [AdminAuthController::class, 'login'])->name('login-page');
Route::post('admins/login', [AdminAuthController::class, 'auth'])->name('login');
Route::get('admins/logout', [AdminAuthController::class, 'logout'])->name('logout');

Route::prefix('admins')->name('admins.')->middleware('admin.auth')->group(function () {
    Route::get('/',[AdminsController::class,'index'])->name('list');
    Route::get('/{id}',[AdminsController::class,'getOne'])->whereNumber('id')->name('admin');
    Route::get('/show',[AdminsController::class,'show']);
    Route::post('/create',[AdminsController::class,'create']);
    Route::get('/{id}/update',[AdminsController::class,'update'])->name('update');
    Route::post('/{id}', [AdminsController::class, 'edit'])->whereNumber('id')->name('edit');
    Route::delete('/{id}',[AdminsController::class,'destroy'])->whereNumber('id')->name('delete');
});

Route::prefix('products')->name('products.')->group(function (){
    Route::get('/',[ProductsController::class,'index'])->name('list');
    Route::get('/{id}',[ProductsController::class,'getOne'])->whereNumber('id')->name('product');
    Route::get('/create',[ProductsController::class,'create'])->name('create');
    Route::delete('/{id}',[ProductsController::class,'destroy'])->whereNumber('id')->name('delete');
    Route::get('/{id}/update',[ProductsController::class,'update'])->whereNumber('id')->name('update');
    Route::post('/', [ProductsController::class, 'store'])->name('store');
    Route::post('/{id}', [ProductsController::class, 'edit'])->whereNumber('id')->name('edit');
});

Route::get('registration', [AdminRegistrationController::class, 'view'])->name('register-page');
Route::post('registration', [AdminRegistrationController::class, 'post'])->name('register');
Route::get('registration/verification/{token}', [AdminRegistrationController::class, 'verification'])->name('registration.verification');

Route::prefix('users')->name('users.')->group(function (){
    Route::get('/',[UserController::class,'index'])->name('list');
    Route::get('/{id}',[UserController::class,'getOne'])->whereNumber('id')->name('user');
    Route::get('/{id}/update',[UserController::class,'update'])->whereNumber('id')->name('update');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::post('/{id}', [UserController::class, 'edit'])->whereNumber('id')->name('edit');
    Route::delete('/{id}', [UserController::class, 'destroy'])->whereNumber('id')->name('delete');
});

Route::prefix('orders')->name('orders.')->group(function (){
    Route::get('/',[OrdersController::class,'index'])->name('list');
    Route::get('/create',[OrdersController::class,'create'])->name('create');
    Route::post('/', [OrdersController::class, 'store'])->name('store');
    //Route::get('/{id}',[OrdersController::class,'getOne'])->name('order');
    Route::get('/{id}/update',[OrdersController::class,'update'])->whereNumber('id');
    Route::post('/{id}', [OrdersController::class, 'edit'])->whereNumber('id')->name('edit');
    Route::get('/statistic',[OrdersController::class,'orderStatistic'])->name('statistic');
});



