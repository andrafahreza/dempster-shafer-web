<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\RuleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->middleware('guest')->name('login');
Route::get('login', [AuthController::class, 'index'])->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::get('gejala', [GejalaController::class, 'index'])->name('home');
    Route::post('gejala/tambah', [GejalaController::class, 'tambah'])->name('tambah-gejala');
    Route::post('gejala/show-edit', [GejalaController::class, 'show_edit'])->name('show-gejala');
    Route::post('gejala/edit', [GejalaController::class, 'edit'])->name('edit-gejala');
    Route::post('gejala/hapus', [GejalaController::class, 'hapus'])->name('hapus-gejala');

    Route::get('penyakit', [PenyakitController::class, 'index'])->name('home');
    Route::post('penyakit/tambah', [PenyakitController::class, 'tambah'])->name('tambah-penyakit');
    Route::post('penyakit/show-edit', [PenyakitController::class, 'show_edit'])->name('show-penyakit');
    Route::post('penyakit/edit', [PenyakitController::class, 'edit'])->name('edit-penyakit');
    Route::post('penyakit/hapus', [PenyakitController::class, 'hapus'])->name('hapus-penyakit');

    Route::get('basis_pengetahuan', [RuleController::class, 'index'])->name('home');
    Route::post('basis_pengetahuan/tambah', [RuleController::class, 'tambah'])->name('tambah-basis_pengetahuan');
    Route::post('basis_pengetahuan/hapus', [RuleController::class, 'hapus'])->name('hapus-basis_pengetahuan');
});
