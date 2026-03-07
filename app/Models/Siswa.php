<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;

    protected $table = 'siswa';

    protected $fillable = [
        'nama',
        'nis',
        'kelas',
        'jenis_kelamin',
        'tahun_ajaran',
        'foto',
        'status',
    ];
}
