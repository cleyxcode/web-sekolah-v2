<?php

namespace Database\Seeders;

use App\Models\ProfilSekolah;
use Illuminate\Database\Seeder;

class ProfilSekolahSeeder extends Seeder
{
    public function run(): void
    {
        ProfilSekolah::create([
            'nama_sekolah'   => 'SD Negeri Warialau',
            'kepala_sekolah' => '',
            'akreditasi'     => 'B',
            'tahun_berdiri'  => '1980',
            'alamat'         => 'Kec. Aru Utara, Kab. Kepulauan Aru, Maluku',
        ]);
    }
}
