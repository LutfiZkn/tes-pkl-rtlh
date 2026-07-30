<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('rumah', RumahController::class);
Route::resource('kecamatan', KecamatanController::class);
Route::resource('kelurahan', KelurahanController::class);