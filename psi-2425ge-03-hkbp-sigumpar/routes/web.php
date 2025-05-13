<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminWartaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminJadwalController;
use App\Http\Controllers\CongregationController;


/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
*/

// RAPIKAN DULU ROUTE NYA INI SEMUA, PASTIKAN SEMUA ROUTENYA YG DI LIST DISINI KE PAKE


Route::get('/', function () {
    return view('beranda');
});

// Route untuk jadwal
Route::get('/jadwal', function () {
    return view('jadwal.jadwal');
});

// Route ke dashboard admin
Route::get('/dashboardadmin', function () {
    return view('dashboard'); // nanti kita buat view-nya
});

// Route untuk Warta
Route::get('/warta', function () {
    return view('warta.warta'); // arahkan ke folder resources/views/warta/warta.blade.php
});
Route::get('/warta', [AdminWartaController::class, 'indexUser'])->name('user.warta');

// Route untuk profil gereja
Route::get('/profil-gereja', function () {
    return view('profil gereja.profilgereja');
});

// Route Admin Jadwal
Route::get('/AdminJadwal', function () {
    return redirect('/jadwal/AdminJadwal');
});

Route::get('/jadwal/AdminJadwal', [AdminJadwalController::class, 'edit'])->name('jadwal.edit');
Route::post('/jadwal/AdminJadwal', [AdminJadwalController::class, 'update'])->name('jadwal.update');
Route::put('/jadwal/AdminJadwal', [AdminJadwalController::class, 'update'])->name('jadwal.update');


// Route untuk fitur reservasi
Route::get('/reservasi', [ReservasiController::class, 'index']);
Route::get('/reservasi/{jenis}', [ReservasiController::class, 'showForm']);

// Menampilkan daftar warta admin
Route::get('/wartaadmin', [AdminWartaController::class, 'index'])->name('admin.warta.index');

// Menyimpan data warta
Route::post('/wartaadd', [AdminWartaController::class, 'store'])->name('admin.warta.store');

// Menampilkan form tambah warta
Route::get('/wartaadd', [AdminWartaController::class, 'create'])->name('admin.warta.create');

// Mendownload file warta
Route::get('/admin/warta/download/{id}', [AdminWartaController::class, 'download'])->name('admin.warta.download');

// Menghapus warta
Route::delete('/admin/warta/{id}', [AdminWartaController::class, 'destroy'])->name('admin.warta.destroy');

// Route dashboard, hanya bisa diakses jika sudah login dan terverifikasi
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Profile routes
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

// Route untuk jadwal
Route::get('/jadwal', [JadwalController::class, 'edit'])->name('jadwal.edit');

// Halaman Notifikasi
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

//Admin
Route::middleware(['auth', 'verified'])->group(function () {

    // ✅ Dashboard (Admin)
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // ✅ Admin Jadwal


    // ✅ Warta (Admin)
    Route::prefix('admin/warta')->group(function () {
        Route::get('/', [AdminWartaController::class, 'index'])->name('admin.warta.index');
        Route::get('/create', [AdminWartaController::class, 'create'])->name('admin.warta.create');
        Route::post('/store', [AdminWartaController::class, 'store'])->name('admin.warta.store');
        Route::get('/download/{id}', [AdminWartaController::class, 'download'])->name('admin.warta.download');
        Route::delete('/{id}', [AdminWartaController::class, 'destroy'])->name('admin.warta.destroy');
    });

    // ✅ Congregation
    Route::resource('congregations', CongregationController::class)->except(['show']);
    Route::resource('congregations', CongregationController::class);
    Route::get('/admin/congregations', [CongregationController::class, 'index'])->name('admin.congregations.index');
    Route::get('/congregations/stats', [CongregationController::class, 'stats'])->name('admin.congregations.stats');
    Route::get('/congregations/{id}/edit', [CongregationController::class, 'edit'])->name('congregations.edit');
    Route::put('/congregations/{id}', [CongregationController::class, 'update'])->name('congregations.update');


    // ✅ Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
