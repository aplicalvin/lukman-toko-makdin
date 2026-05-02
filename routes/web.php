<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('admin.dashboard'));

// Admin Routes
// Add ->middleware(['auth']) when authentication is ready
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',            [AdminController::class, 'dashboard'])          ->name('dashboard');
    Route::get('/karyawan',             [AdminController::class, 'karyawan'])           ->name('karyawan');
    Route::get('/rekap-presensi',       [AdminController::class, 'rekapPresensi'])      ->name('rekap-presensi');
    Route::get('/presensi-bermasalah',  [AdminController::class, 'presensiRermasalah'])->name('presensi-bermasalah');
    Route::get('/rekap-gaji-harian',    [AdminController::class, 'rekapGajiHarian'])    ->name('rekap-gaji-harian');
    Route::get('/rekap-gaji-bulanan',   [AdminController::class, 'rekapGajiBulanan'])   ->name('rekap-gaji-bulanan');
    Route::get('/daftar-admin',         [AdminController::class, 'daftarAdmin'])        ->name('daftar-admin');
    Route::get('/pengaturan',           [AdminController::class, 'pengaturan'])         ->name('pengaturan');
});

// Placeholder logout route (replace with Fortify/Breeze when auth is set up)
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

