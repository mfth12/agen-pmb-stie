<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DasborController;
use App\Http\Controllers\Auth\MasukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ApprovalController;

// Rute "/" universal, tidak pakai middleware
Route::get('/', fn() => redirect()->route(Auth::check() ? 'dashboard.index' : 'login'));

// Rute masuk
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [MasukController::class, 'index'])->name('login');
    Route::post('/login', [MasukController::class, 'masuk'])->name('login.do');
});

// Rute dasbor dengan permission
Route::middleware(['auth'])->group(function () {
    // Dashboard routes - semua role yang login bisa akses dashboard
    Route::get('/dasbor', [DasborController::class, 'index'])->name('dashboard.index')
        ->middleware('permission:dashboard_view');

    Route::get('/dasbor_lawas', [DasborController::class, 'index_lawas'])->name('dashboard.lawas')
        ->middleware('permission:dashboard_view');

    Route::post('/keluar', [MasukController::class, 'keluar'])->name('logout');

    // User Management Routes - hanya untuk superadmin dan baak
    Route::prefix('users')->middleware(['permission:user_view'])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create')
            ->middleware('permission:user_create');
        Route::post('/', [UserController::class, 'store'])->name('users.store')
            ->middleware('permission:user_create');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit')
            ->middleware('permission:user_edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update')
            ->middleware('permission:user_edit');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy')
            ->middleware('permission:user_delete');
    });

    // Pengajuan Routes - bisa diakses oleh multiple roles
    Route::prefix('pengajuan')->middleware(['permission:pengajuan_view'])->group(function () {
        Route::get('/', [PengajuanController::class, 'index'])->name('pengajuan.index');
        Route::get('/create', [PengajuanController::class, 'create'])->name('pengajuan.create')
            ->middleware('permission:pengajuan_create');
        Route::post('/', [PengajuanController::class, 'store'])->name('pengajuan.store')
            ->middleware('permission:pengajuan_create');
        Route::get('/{pengajuan}', [PengajuanController::class, 'show'])->name('pengajuan.show');
        Route::get('/{pengajuan}/edit', [PengajuanController::class, 'edit'])->name('pengajuan.edit')
            ->middleware('permission:pengajuan_edit');
        Route::put('/{pengajuan}', [PengajuanController::class, 'update'])->name('pengajuan.update')
            ->middleware('permission:pengajuan_edit');
        Route::delete('/{pengajuan}', [PengajuanController::class, 'destroy'])->name('pengajuan.destroy')
            ->middleware('permission:pengajuan_delete');
    });

    // Approval Routes - untuk baak dan prodi
    Route::prefix('approval')->middleware(['permission:approval_view'])->group(function () {
        Route::get('/', [ApprovalController::class, 'index'])->name('approval.index');
        Route::get('/{pengajuan}', [ApprovalController::class, 'show'])->name('approval.show');
        Route::post('/{pengajuan}/approve', [ApprovalController::class, 'approve'])->name('approval.approve')
            ->middleware('permission:approval_approve');
        Route::post('/{pengajuan}/reject', [ApprovalController::class, 'reject'])->name('approval.reject')
            ->middleware('permission:approval_reject');
        Route::post('/{pengajuan}/verify', [ApprovalController::class, 'verify'])->name('approval.verify')
            ->middleware('permission:approval_verify');
    });

    // Keuangan Routes - khusus untuk role keuangan
    Route::prefix('keuangan')->middleware(['permission:keuangan_view'])->group(function () {
        Route::get('/', [KeuanganController::class, 'index'])->name('keuangan.index');
        Route::post('/{pengajuan}/process', [KeuanganController::class, 'process'])->name('keuangan.process')
            ->middleware('permission:keuangan_manage');
    });

    // Akademik Routes - untuk prodi dan dosen
    Route::prefix('akademik')->middleware(['permission:akademik_view'])->group(function () {
        Route::get('/', [AkademikController::class, 'index'])->name('akademik.index');
        Route::post('/manage', [AkademikController::class, 'manage'])->name('akademik.manage')
            ->middleware('permission:akademik_manage');
    });
});

//route resource for products
Route::resource('/nonakademiks', \App\Http\Controllers\NonkadController::class);
Route::resource('/transaknonakademiks', \App\Http\Controllers\transaknonkadController::class);
Route::resource('/mahasiswa', \App\Http\Controllers\MahasiswaController::class);
Route::resource('/multiakademik', \App\Http\Controllers\multiakademiksController::class);
Route::get('/uploadsertifikat', [\App\Http\Controllers\multiakademiksController::class, 'sertifikatup'])->name('uploadsertifikat');

// Route::resource('/transakademik', \App\Http\Controllers\multiakademiksController::class);