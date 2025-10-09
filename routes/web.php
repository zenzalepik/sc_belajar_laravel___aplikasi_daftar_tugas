<?php

use App\Http\Controllers\TugasPengontrol;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tugas', TugasPengontrol::class)->parameters([
    'tugas' => 'tugas'
]);
