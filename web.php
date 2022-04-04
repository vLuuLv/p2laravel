<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\FasilitasKamarController;
use App\Http\Controllers\FasilitasHotelController;

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

// Route halaman Login
Route::get('/', [LoginController::class, 'index'])->name('home')->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');

Route::get('/register', [LoginController::class, 'register'])->middleware('guest')->name('register');

// Route Validasi Login
Route::post('/login', [LoginController::class, 'authenticate'])->middleware(['guest']);
Route::post('/register', [LoginController::class, 'daftar'])->middleware(['guest']);

// Route halaman setelah Auth
Route::middleware(['auth'])->group(function () {

    // Route untuk menampilkan halaman Home
    Route::get('/home', [LoginController::class, 'home'])->name('home.index');

    // Route untuk menampilkan halaman Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Route halaman untuk role Admin
Route::middleware(['role:admin'])->group(function () {

    // Route untuk menampilkan halaman kamar
    Route::resource('/kamar', KamarController::class);

    // Route untuk menampilkan halaman fasilitas kamar
    Route::resource('/fasilitas-kamar', FasilitasKamarController::class);

    // Route untuk menampilkan halaman fasilitas hotel
    Route::resource('/fasilitas-hotel', FasilitasHotelController::class);
});
