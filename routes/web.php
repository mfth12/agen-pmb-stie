<?php

use Illuminate\View\View;

//import return type View
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MasukController;

Route::get('/', [MasukController::class, 'index'])
    ->name('masuk')
    ->middleware(['guest', 'cache.headers']);

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