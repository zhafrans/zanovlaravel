<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AppController::class, 'index']);



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute dashboard dengan middleware auth

Route::middleware(['CheckToken'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
 
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi');
    Route::post('transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit'); // Rute untuk edit
    Route::put('transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update'); // Rute untuk update
    Route::delete('transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy'); // Rute untuk hapus
    // Route::put('/editTotalUang', [DashboardController::class, 'editTotalUang'])->name('editTotalUang');

});

