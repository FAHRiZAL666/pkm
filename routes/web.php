<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\BookingController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

// Halaman Home
Route::get('/home', [AuthManager::class, 'home'])->name('home');

// Halaman Utama Untuk Booking
Route::get('/main', [AuthManager::class, 'main'])->name('main');
Route::post('/main', [AuthManager::class, 'mainPost'])->name('main.post');

// Rute Booking
Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::post('/booking', [BookingController::class, 'newStore'])->name('booking.store');

// Rute Karcis
Route::get('/karcis', [BookingController::class, 'showKarcis'])->name('karcis');

