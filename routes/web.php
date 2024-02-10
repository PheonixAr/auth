<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\customersdetails;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Models\customer;
use App\Http\Controllers\OtpController;
// use App\Http\Controllers\customersController;



Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
    Route::get('/admin', [AuthController::class, 'adminlogin'])->name('admin');
    Route::post('/admin', [AuthController::class, 'adminloginPost'])->name('admin');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::resource('/product', ProductController::class);
Route::resource('/customer', CustomersController::class);




// Route::get('/customer', [CustomersController::class, 'vadmin'])->name('vadmin');
// Route::post('/customer', [CustomersController::class, 'vadmin'])->name('vadmin');

// Route::get('/index',[CustomersController::class,'index'])->name('customer');
// Route::get('/ajax-paginate',[CustomersController::class,'ajax_paginate'])->name('customer');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::post('/send-otp', [OtpController::class, 'sendOtp']);
Route::get('/verification/{id}', [UserController::class, 'verification']);
Route::post('/verified', [UserController::class, 'verifiedOtp'])->name('verifiedOtp');
Route::get('/resend-otp', [UserController::class, 'resendOtp'])->name('resendOtp');

Route::get('/forgot', [CustomersController::class, 'forgot'])->name('forgot');
Route::Post('/forgot', [UserController::class, 'studentRegister'])->name('studentRegister');
