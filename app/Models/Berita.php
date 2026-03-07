<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berita extends Model
{
    use SoftDeletes;

    protected $table = 'berita';

    protected $fillable = [
        'user_id',
        'judul',
        'isi',
        'gambar',
        'kategori',
        'tanggal_publish',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
