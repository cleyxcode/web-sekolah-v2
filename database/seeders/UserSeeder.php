<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role'     => 'admin',
        ]);
    }
}
