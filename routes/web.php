<?php

use Illuminate\View\View;

//import return type View
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasukController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [MasukController::class, 'index'])
    ->name('home')
    ->middleware(['guest', 'set.konfigs', 'cache.headers']);

//route resource for products
Route::resource('/nonakademiks', \App\Http\Controllers\NonkadController::class);
Route::resource('/transaknonakademiks', \App\Http\Controllers\transaknonkadController::class);
Route::resource('/mahasiswa', \App\Http\Controllers\MahasiswaController::class);
Route::resource('/multiakademik', \App\Http\Controllers\multiakademiksController::class);
Route::get('/uploadsertifikat', [\App\Http\Controllers\multiakademiksController::class, 'sertifikatup'])->name('uploadsertifikat');

// Route::resource('/transakademik', \App\Http\Controllers\multiakademiksController::class);