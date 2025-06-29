<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\WartaController;
use App\Http\Controllers\JemaatController;
use App\Http\Controllers\LayananGerejaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DataJemaatController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PemberitahuanController;
use App\Models\Notification;
use App\Models\Pemberitahuan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilePendetaController;

// Public Routes (No login required)
Route::get('/', [EventController::class, 'events'])->name('dashboard');  // Dashboard is accessible without login
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
Route::post('/jadwal/update-massal', [JadwalController::class, 'updateMassal'])->name('jadwal.updateMassal');
Route::get('/warta', [WartaController::class, 'index'])->name('warta');
Route::view('/profilegereja', 'halaman.profilegereja.admin.profilegereja')->name('profilegereja');
Route::get('/dashboard', [EventController::class, 'events'])->name('dashboard'); 
Route::get('/layanangereja', [LayananGerejaController::class, 'index'])->name('layanangereja.index');

// Layanan Gereja route
    Route::get('/layanan', [LayananGerejaController::class, 'index'])->name('layanan');
// Authenticated routes with verification middleware
Route::middleware(['auth', 'verified'])->group(function () {

    
    // Mass update and resource route for Jadwal
    
    Route::put('/jadwal/mass-update', [JadwalController::class, 'massUpdate'])->name('jadwal.massUpdate');
    // resource jadwal kecuali index
    Route::resource('jadwal', JadwalController::class)->except(['index']);

    

    // Pemberitahuan with controller
    Route::get('/pemberitahuan', [PemberitahuanController::class, 'index'])->name('pemberitahuan');
    Route::post('/pemberitahuan/{id}/mark-as-read', [PemberitahuanController::class, 'markAsRead'])->name('pemberitahuan.markAsRead');
    Route::put('/pemberitahuan/{id}/update-status', [PemberitahuanController::class, 'updateStatus'])->name('pemberitahuan.updateStatus');
    Route::get('/pemberitahuan/create', [PemberitahuanController::class, 'create'])->name('pemberitahuan.create');
    Route::post('/pemberitahuan', [PemberitahuanController::class, 'store'])->name('pemberitahuan.store');

    // Layanan Gereja resource routes
    
    Route::get('/layanangereja/create', [LayananGerejaController::class, 'create'])->name('layanangereja.create');
    Route::post('/layanangereja', [LayananGerejaController::class, 'store'])->name('layanangereja.store');
    Route::post('/layanan/{id}/update-status', [LayananGerejaController::class, 'updateStatus'])->name('layanan.updateStatus');
    Route::post('/layanan/{kode}/toggle-status', [LayananGerejaController::class, 'toggleStatus'])->name('layanan.toggleStatus');
    // Route untuk menghapus file sertifikat
    Route::delete('/layanangereja/{id}/remove-file', [LayananGerejaController::class, 'removeFile'])->name('layanangereja.removeFile');

    
   // DataJemaats resource with admin role middleware on specific routes
        Route::resource('datajemaat', DataJemaatController::class)->except(['show']);
        Route::get('/datajemaat', [DataJemaatController::class, 'index'])
            ->name('datajemaat');
        Route::get('/datajemaat/{id}/edit', [DataJemaatController::class, 'edit'])
            ->name('datajemaat.edit')->middleware('role:admin');
        Route::put('/datajemaat/{id}', [DataJemaatController::class, 'update'])
            ->name('datajemaat.update')->middleware('role:admin');
        Route::get('/datajemaat/statistics', [DataJemaatController::class, 'statistics'])
            ->name('datajemaat.statistics')->middleware('role:admin');
        Route::delete('/datajemaat/{id}', [DataJemaatController::class, 'destroy'])
            ->name('datajemaat.destroy');



    // Warta and Jadwal resources with role middleware
    Route::resource('warta', WartaController::class)->except(['index']);
});

// Profile management routes (auth required)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__ . '/auth.php';

// Google OAuth routes
Route::get('login/google', [GoogleAuthController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

// Admin routes prefix
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('events', EventController::class);
});

// web.php

Route::get('/pemberitahuan/{id}', [PemberitahuanController::class, 'show'])->name('pemberitahuan.show');


Route::get('/layanangereja/{id}', [LayananGerejaController::class, 'show'])->name('layanangereja.show');
Route::delete('/layanangereja/{id}', [LayananGerejaController::class, 'destroy'])->name('layanangereja.destroy');
// Pemberitahuan Routes
Route::middleware(['auth'])->group(function () {
    Route::delete('/pemberitahuan/{id}', [PemberitahuanController::class, 'destroy'])->name('pemberitahuan.destroy');
});

use App\Http\Controllers\ProfileGerejaController;

// Route untuk menampilkan halaman profile gereja (view profil gereja)
Route::get('/profilegereja', [ProfileGerejaController::class, 'show'])->name('profilegereja');

// Route untuk menampilkan halaman edit profile gereja (admin)
Route::get('/profilegereja/edit', [ProfileGerejaController::class, 'edit'])->name('profilegereja.edit');

// Route untuk menyimpan data profile gereja
Route::post('/profilegereja/store', [ProfileGerejaController::class, 'store'])->name('profilegereja.store');

// Route untuk memperbarui data profile gereja
Route::put('/profilegereja/{id}', [ProfileGerejaController::class, 'update'])->name('profilegereja.update');



Route::get('/profil-pendeta', [ProfilePendetaController::class, 'index']);

Route::get('/admin/profile-pendeta/edit', [ProfilePendetaController::class, 'edit'])->name('admin.profile-pendeta.edit');
Route::put('/admin/profile-pendeta', [ProfilePendetaController::class, 'update'])->name('admin.profile-pendeta.update');

Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
Route::put('/pemberitahuan/{layanan}/alasan', [PemberitahuanController::class, 'updateAlasan'])->name('pemberitahuan.updateAlasan');