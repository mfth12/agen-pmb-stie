<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DasborController;
use App\Http\Controllers\Auth\MasukController;

// Rute "/" universal, tidak pakai middleware
Route::get('/', fn() => redirect()->route(Auth::check() ? 'dashboard.index' : 'login'));

// Rute masuk
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [MasukController::class, 'index'])->name('login');
    // Route::get('/login', [MasukController::class, 'index'])->name('masuk');
    Route::post('/login', [MasukController::class, 'masuk'])->name('login.do');
    // Alias untuk kompatibilitas bawaan Laravel
});

// Rute dasbor
Route::middleware([
    'auth',
])->group(
    function () {
        Route::get('/dasbor', [DasborController::class, 'index'])->name('dashboard.index');
        Route::get('/dasbor_lawas', [DasborController::class, 'index_lawas'])->name('dashboard.lawas');
        // Route::get('/dasbor/crm', [DasborUtama::class, 'crm'])->name('dashboard.crm');
        // Route::get('/profil', [ProfilController::class, 'index'])->name('profil-index'); //not used again
        Route::post('/keluar', [MasukController::class, 'keluar'])->name('logout');
    }
);

//route resource for products
Route::resource('/nonakademiks', \App\Http\Controllers\NonkadController::class);
Route::resource('/transaknonakademiks', \App\Http\Controllers\transaknonkadController::class);
Route::resource('/mahasiswa', \App\Http\Controllers\MahasiswaController::class);
Route::resource('/multiakademik', \App\Http\Controllers\multiakademiksController::class);
Route::get('/uploadsertifikat', [\App\Http\Controllers\multiakademiksController::class, 'sertifikatup'])->name('uploadsertifikat');

// Route::resource('/transakademik', \App\Http\Controllers\multiakademiksController::class);