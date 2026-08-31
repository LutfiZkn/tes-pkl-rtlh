<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FotoRumahController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PetaController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    //Dashboard
    Route::get('/dashboard', [RumahController::class, 'dashboard'])
        ->name('dashboard');

    //Peta Sebaran
    Route::get('/peta', [PetaController::class, 'index'])
        ->name('peta.index');
        
     //Rumah
    Route::get('/rumah/trash', [RumahController::class, 'trash'])
        ->name('rumah.trash');
    Route::patch('/rumah/{id}/restore', [RumahController::class, 'restore'])
        ->name('rumah.restore');
    Route::delete('/rumah/{id}/force-delete', [RumahController::class, 'forceDelete'])
        ->name('rumah.forceDelete');

    //Export excel
    Route::get('/rumah/export-excel', [RumahController::class, 'export'])
        ->name('rumah.export.excel');

    //Export PDF
    Route::get('/rumah/export-pdf', [RumahController::class, 'exportPdf'])
        ->name('rumah.export.pdf');

    Route::resource('rumah', RumahController::class);

    //Riwayat
    Route::get('/rumah/{rumah}/riwayat/create', [RiwayatController::class, 'create'])
        ->name('rumah.riwayat.create');

    Route::post('/rumah/{rumah}/riwayat', [RiwayatController::class, 'store'])
        ->name('rumah.riwayat.store');

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