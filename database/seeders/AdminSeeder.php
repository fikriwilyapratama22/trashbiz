<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Admin::create([
            'nama' => 'Admin',
            'alamat' => 'Supayang',
            'no_hp_wa' => '083180203746',
            'email' => 'admin@gmail.com',
            'jabatan' => 'Admin',
            'password' => bcrypt('123'), // Hashing password
        ]);
    }
}
