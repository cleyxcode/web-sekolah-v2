<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'logo',           'value' => null, 'type' => 'image'],
            ['key' => 'background',     'value' => null, 'type' => 'image'],
            ['key' => 'favicon',        'value' => null, 'type' => 'image'],
            ['key' => 'alamat_sekolah', 'value' => null, 'type' => 'text'],
            ['key' => 'no_telp',        'value' => null, 'type' => 'text'],
            ['key' => 'email_sekolah',  'value' => null, 'type' => 'text'],
            ['key' => 'facebook_url',   'value' => null, 'type' => 'url'],
            ['key' => 'instagram_url',  'value' => null, 'type' => 'url'],
            ['key' => 'maps_embed',     'value' => null, 'type' => 'text'],
        ];

        foreach ($settings as $s) {
            Setting::create($s);
        }
    }
}
