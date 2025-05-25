<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\WartaController;
use App\Http\Controllers\JemaatController;
use App\Http\Controllers\LayananGerejaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CongregationController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\NotificationController;
use App\Models\Notification;
use Illuminate\Support\Facades\Route;

// Public Routes (No login required)
Route::get('/', [EventController::class, 'events'])->name('dashboard');  // Dashboard is accessible without login
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
Route::post('/jadwal/update-massal', [JadwalController::class, 'updateMassal'])->name('jadwal.updateMassal');
Route::get('/warta', [WartaController::class, 'index'])->name('warta.index');
Route::view('/profilegereja', 'halaman.profilegereja.admin.profilegereja')->name('profilegereja');
Route::get('/dashboard', [EventController::class, 'events'])->name('dashboard'); 

// Authenticated routes with verification middleware
Route::middleware(['auth', 'verified'])->group(function () {

    
    // Mass update and resource route for Jadwal
    Route::put('/jadwal/mass-update', [JadwalController::class, 'massUpdate'])->name('jadwal.massUpdate');
    // resource jadwal kecuali index
    Route::resource('jadwal', JadwalController::class)->except(['index']);

    // Layanan Gereja route
    Route::get('/layanan', [LayananGerejaController::class, 'index'])->name('layanan');

    // Pemberitahuan with controller
    Route::get('/pemberitahuan', [NotificationController::class, 'index'])->name('pemberitahuan');
    Route::post('/pemberitahuan/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('pemberitahuan.markAsRead');

    // Layanan Gereja resource routes
    Route::get('/layanangereja', [LayananGerejaController::class, 'index'])->name('layanangereja.index');
    Route::get('/layanangereja/create', [LayananGerejaController::class, 'create'])->name('layanangereja.create');
    Route::post('/layanangereja', [LayananGerejaController::class, 'store'])->name('layanangereja.store');
    Route::post('/layanan/{id}/update-status', [LayananGerejaController::class, 'updateStatus'])->name('layanan.updateStatus');
    Route::post('/layanan/{kode}/toggle-status', [LayananGerejaController::class, 'toggleStatus'])->name('layanan.toggleStatus');
    
    // Congregations resource with admin role middleware on specific routes
    Route::resource('congregations', CongregationController::class)->except(['show']);
    Route::get('/admin/congregations', [CongregationController::class, 'index'])
        ->name('halaman.congregations.index')->middleware('role:admin');
    Route::get('/congregations/{id}/edit', [CongregationController::class, 'edit'])
        ->name('congregations.edit')->middleware('role:admin');
    Route::put('/congregations/{id}', [CongregationController::class, 'update'])
        ->name('congregations.update')->middleware('role:admin');
    Route::get('/congregations/statistics', [CongregationController::class, 'statistics'])
        ->name('congregations.statistics')->middleware('role:admin');

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

Route::middleware(['auth'])->group(function () {
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});
