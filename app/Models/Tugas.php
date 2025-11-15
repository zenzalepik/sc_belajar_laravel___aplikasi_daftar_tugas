<?php
// D:\Github\sc_belajar_laravel___aplikasi_daftar_tugas\app\Models\Tugas.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tugas extends Model
{
    //
    
    protected $table = 'tugas';

    protected $fillable = [
        'judul',
        'deskripsi',
        'selesai',
        'deadline',
        'slug'
    ];

    
    protected static function booted()
    {
        static::creating(function ($tugas) {
            $tugas->slug = Str::slug($tugas->judul) . '-' . Str::random(5);
        });
    }
}
