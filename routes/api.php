<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(["prefix" => "V1",],function(){
    Route::resource('user',UserController::class);
    Route::get('admin', [LoginController::class, 'login'])->name('login');
    Route::post('admin/login-user', [LoginController::class, 'loginuser'])->name('login-user');
    
    Route::prefix('admin')->group(function () {

    Route::post('user-store', [UserController::class, 'store'])->name('store');
        Route::resource('user', UserController::class);
    });

});

