<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::get('/user-pengguna', [UserController::class, 'index'])->middleware('auth');
Route::post('/user-pengguna', [UserController::class, 'show'])->middleware('auth');
Route::post('/insert-user-pengguna', [UserController::class, 'store'])->middleware('auth');
Route::get('/ajax-user-pengguna/{id}', [UserController::class, 'ajax_data'])->middleware('auth');
Route::post('/update-user-pengguna', [UserController::class, 'update'])->middleware('auth');
Route::get('/delete-user-pengguna/{id}', [UserController::class, 'destroy'])->middleware('auth');