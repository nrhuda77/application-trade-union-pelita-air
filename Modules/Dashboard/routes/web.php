<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\Http\Controllers\DashboardController;
use Modules\EventPengumuman\Http\Controllers\EventPengumumanController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard-event-pengumuman', [EventPengumumanController::class, 'show'])->middleware('auth:anggota');
Route::get('/dashboard-user', [DashboardController::class, 'anggota'])->name('dashboard')->middleware('auth:anggota');