<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/gambar/{nama}/{nama2}', function ($nama, $nama2) {
    $path = base_path('assets/' . $nama . '/' . $nama2);
    if (!file_exists($path)) {
        abort(403);
    }
    return response()->file($path);
});

Route::get('/event-lampiran/{data}/{data2}', function ($data, $data2) {
    $path = base_path('pengumuman-file/' . $data . '/' . $data2);
    if (!file_exists($path)) {
        abort(403);
    }
    return response()->file($path);
});