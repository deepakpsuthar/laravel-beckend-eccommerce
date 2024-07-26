<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

require 'admin.php';
Route::get('/',[HomeController::class,'index']);
Route::get('/login',[AuthController::class,'index'])->name('login');
Route::post('/login',[AuthController::class,'login']);
