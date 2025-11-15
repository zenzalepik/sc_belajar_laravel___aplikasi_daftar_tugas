<?php
// D:\Github\sc_belajar_laravel___aplikasi_daftar_tugas\routes\web.php

use App\Http\Controllers\TugasPengontrol;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Statistik (harus di atas resource agar tidak bentrok)
Route::get('/tugas/statistik', [TugasPengontrol::class, 'statistikTugas'])->name('tugas.statistik');

// Detail by slug
Route::get('/tugas/detail/{slug}', [TugasPengontrol::class, 'detailBySlug'])->name('tugas.detail');

// Export data tugas
Route::get('/tugas/export', [TugasPengontrol::class, 'export'])->name('tugas.export');

// Resource utama (termasuk index, create, store, show, edit, update, destroy)
Route::resource('tugas', TugasPengontrol::class)->parameters([
    'tugas' => 'tugas'
]);

// Fallback untuk halaman tidak ditemukan
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
