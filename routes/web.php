<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FotoRumahController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
     // Rumah
    Route::get('/rumah/trash', [RumahController::class, 'trash'])
        ->name('rumah.trash');
    Route::patch('/rumah/{id}/restore', [RumahController::class, 'restore'])
        ->name('rumah.restore');
    Route::delete('/rumah/{id}/force-delete', [RumahController::class, 'forceDelete'])
        ->name('rumah.forceDelete');

    Route::resource('rumah', RumahController::class);

    //Kecamatan & Kelurahan
    Route::resource('kecamatan', KecamatanController::class);
    Route::resource('kelurahan', KelurahanController::class); 

    // Foto Rumah
    Route::delete('/foto-rumah/{fotoRumah}', [FotoRumahController::class, 'destroy'])
    ->name('foto-rumah.destroy');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {

    Route::patch('/rumah/{rumah}/verifikasi', [RumahController::class, 'updateVerifikasi'])
        ->name('rumah.verifikasi');

    Route::resource('user', UserController::class);
});