<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use SoftDeletes;

    protected $table = 'guru';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'mata_pelajaran',
        'no_hp',
        'foto',
        'status',
    ];
}
