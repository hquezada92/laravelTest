<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// login
Route::post('/login', [UserController::class,'login']);

// Registrar usuario
Route::post('/register',[UserController::class,'register']);

//Reset password
Route::post('/forgot-password',[UserController::class,'forgotPassword']);
Route::post('/reset-password',[UserController::class,'resetPassword'])->name('password.reset');

// logout
Route::post('/logout', function (Request $request) {
    auth()->logout();
    return response()->json(['Success'=>'Logout'],200);
});

// Resource route users
Route::resource('users', 'UserController')->middleware('auth');
// Resource route products
Route::resource('products', 'ProductController')->middleware('auth');
Route::get('searchProduct/{value}',[ProductController::class,'searchProduct'])->middleware('auth');