<?php

use Illuminate\Support\Facades\Route;
use Modules\EventPengumuman\Http\Controllers\EventPengumumanController;

Route::get('/event-pengumuman', [EventPengumumanController::class, 'index'])->middleware('auth');
Route::get('/data-event-pengumuman', [EventPengumumanController::class, 'show'])->middleware('auth');
Route::post('/create-event-pengumuman', [EventPengumumanController::class, 'store'])->middleware('auth');
Route::get('/ajax-data-event-pengumuman/{id}', [EventPengumumanController::class, 'ajax_data'])->middleware('auth');
Route::post('/update-data-event-pengumuman', [EventPengumumanController::class, 'update'])->middleware('auth');
Route::get('/delete-data-event/{id}', [EventPengumumanController::class, 'destroy'])->middleware('auth');