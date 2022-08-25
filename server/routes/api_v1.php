<?php

use App\Http\Controllers\Api\v1\OrdersApiController;
use App\Http\Controllers\Api\v1\ProductsApiController;
use App\Http\Controllers\Api\v1\UserAuthenticationController;
use App\Http\Controllers\Api\v1\UsersApiController;
use App\Http\Controllers\Api\v1\UsersRegistrationController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserAuthenticationController::class, 'login']);

Route::prefix('registration')->name('registration.')->group(function (){
    Route::post('/',[UsersRegistrationController::class,'post']);
    Route::get('/verification/{token}',[UsersRegistrationController::class,'verification'])->name('verify');
});

Route::prefix('users')->group(function (){
    Route::get('/', [UsersApiController::class, 'index']);
});

Route::prefix('products')->group(function (){
    Route::get('/', [ProductsApiController::class, 'index']);
    Route::get('/{id}', [ProductsApiController::class, 'getOne']);
});

Route::prefix('orders')->group(function (){
    Route::get('/list/{id}',[OrdersApiController::class,'userOrders']);
    Route::post('/create',[OrdersApiController::class,'create']);
    Route::get('/token/{token}',[OrdersApiController::class,'userIdByToken']);
});
