<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DasborController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\Auth\MasukController;

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

    // Manajemen Pengguna Routes - hanya untuk superadmin dan baak
    Route::prefix('pengguna')->middleware(['permission:user_view'])->group(function () {
        Route::get('/', [PenggunaController::class, 'index'])->name('pengguna.index');
        Route::get('/buat', [PenggunaController::class, 'create'])->name('pengguna.create')
            ->middleware('permission:user_create');
        Route::post('/', [PenggunaController::class, 'store'])->name('pengguna.store')
            ->middleware('permission:user_create');
        Route::get('/{pengguna}', [PenggunaController::class, 'show'])->name('pengguna.show');
        Route::get('/{pengguna}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit')
            ->middleware('permission:user_edit');
        Route::put('/{pengguna}', [PenggunaController::class, 'update'])->name('pengguna.update')
            ->middleware('permission:user_edit');
        Route::delete('/{pengguna}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy')
            ->middleware('permission:user_delete');
        Route::post('/{pengguna}/reset-password', [PenggunaController::class, 'resetPassword'])->name('pengguna.reset-password')
            ->middleware('permission:user_edit');
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
