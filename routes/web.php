<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MallController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LantaiController;
use App\Http\Controllers\RFIDController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UsersController;


// admin
Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/mall', [MallController::class, 'index'])->name('mall.index');
    Route::get('/mall/{mall}', [MallController::class, 'show'])->name('mall.show');
    Route::post('/mall', [MallController::class, 'store'])->name('mall.store');
    Route::put('/mall/{mall}', [MallController::class, 'update'])->name('mall.update');
    Route::delete('/mall/{mall}', [MallController::class, 'destroy'])->name('mall.destroy');

    Route::post('/lantai', [LantaiController::class, 'store'])->name('lantai.store');
    Route::put('/lantai/{id_lantai}', [LantaiController::class, 'update'])->name('lantai.update');
    Route::delete('/lantai/{id_lantai}', [LantaiController::class, 'destroy'])->name('lantai.destroy');

    Route::post('/slot', [SlotController::class, 'store'])->name('slot.store');
    Route::put('/slot/{id_slot}', [SlotController::class, 'update'])->name('slot.update');
    Route::delete('/slot/{id_slot}', [SlotController::class, 'destroy'])->name('slot.destroy');


    Route::post('/user', [LantaiController::class, 'store'])->name('lantai.store');
    Route::put('/user/{id_user}', [LantaiController::class, 'update'])->name('lantai.update');
    Route::delete('/user/{id_user}', [LantaiController::class, 'destroy'])->name('lantai.destroy');

    Route::get('users', [UsersController::class, 'index'])->name('users.index');
    Route::post('users', [UsersController::class, 'store'])->name('users.store');
    Route::put('users/{id_user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
});
// end admin

// parkir
Route::post('/masuk-parkiran', [RFIDController::class, 'store']);
Route::post('/keluar-parkiran', [RFIDController::class, 'update']);

// login admin
Route::get('/admin', [AuthManager::class, 'admin'])->name('admin');
Route::post('/admin', [AuthManager::class, 'adminPost'])->name('admin.post');

// login user
Route::get('/', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');

// registrasi 
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');

// logout
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

// user
Route::middleware(['user'])->group(function () {
    Route::get('/home', [AuthManager::class, 'home'])->name('home');

    Route::get('/home/mall/{id_mall}', [BookingController::class, 'show'])->name('home.show');
    Route::get('home/mall/lantai/{id_lantai}', [BookingController::class, 'lantai'])->name('home.mall.lantai');

    Route::post('/main', [AuthManager::class, 'mainPost'])->name('main.post');

    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking', [BookingController::class, 'newStore'])->name('booking.store');

    Route::get('/karcis', [BookingController::class, 'showKarcis'])->name('karcis');

    Route::get('/search', [AuthManager::class, 'search'])->name('search');
});
// end user