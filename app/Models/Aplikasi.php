<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    protected $table = 'aplikasi';

    protected $fillable = [
        'nama_aplikasi',
        'versi',
        'deskripsi',
        'file_apk',
        'ukuran_file',
        'status',
    ];
}
