<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MasukController;

// Rute "/" universal, tidak pakai middleware
Route::get('/', fn() => redirect()->route(Auth::check() ? 'dashboard.index' : 'login'));

// Rute masuk
Route::middleware(['guest'])->group(function () {
    Route::get('/', [MasukController::class, 'index'])->name('masuk');
    Route::post('/', [MasukController::class, 'masuk'])->name('masuk.do');
});

Route::get('/welcome', function () {
    return view('welcome');
});

//route resource for products
Route::resource('/nonakademiks', \App\Http\Controllers\NonkadController::class);
Route::resource('/transaknonakademiks', \App\Http\Controllers\transaknonkadController::class);
Route::resource('/mahasiswa', \App\Http\Controllers\MahasiswaController::class);
Route::resource('/multiakademik', \App\Http\Controllers\multiakademiksController::class);
Route::get('/uploadsertifikat', [\App\Http\Controllers\multiakademiksController::class, 'sertifikatup'])->name('uploadsertifikat');

// Route::resource('/transakademik', \App\Http\Controllers\multiakademiksController::class);