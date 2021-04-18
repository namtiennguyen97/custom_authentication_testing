<?php

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
//
//Route::get('/', function () {
//    return view('index');
//})->name('index');
Route::get('/',[\App\Http\Controllers\UserController::class,'index'])->name('index');
Route::post('/register',[\App\Http\Controllers\UserController::class,'register'])->name('user.register');
Route::post('/check',[\App\Http\Controllers\UserController::class,'check'])->name('user.check');
Route::get('/profile',[\App\Http\Controllers\UserController::class,'userProfile'])->name('user.profile')->middleware('loggedCheck');
Route::post('/logout',[\App\Http\Controllers\UserController::class,'logout'])->name('user.logout');
