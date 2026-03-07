<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';

    protected $fillable = [
        'judul',
        'gambar',
        'urutan',
        'status',
    ];
}
