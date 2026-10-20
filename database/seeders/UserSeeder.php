<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'alamat' => 'Supayang',
            'no_hp_wa' => '083180203746',
            'level' => 'Admin',
            'password' => bcrypt('123'), // Hashing password
        ]);
    }
}
