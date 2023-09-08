<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [UserController::class, 'login_view'])->name('login');
    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::get('register', [UserController::class, 'register_view'])->name('register');
    Route::post('register', [UserController::class, 'register'])->name('register');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [UserController::class, 'home'])->name('home');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});
