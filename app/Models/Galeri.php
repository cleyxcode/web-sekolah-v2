<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galeri extends Model
{
    use SoftDeletes;

    protected $table = 'galeri';

    protected $fillable = [
        'user_id',
        'judul',
        'foto',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
