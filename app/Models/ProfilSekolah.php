<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    protected $table = 'profil_sekolah';

    protected $fillable = [
        'nama_sekolah',
        'kepala_sekolah',
        'akreditasi',
        'tahun_berdiri',
        'jumlah_ruang_kelas',
        'visi',
        'misi',
        'sejarah',
        'alamat',
        'kontak',
        'logo',
    ];
}
