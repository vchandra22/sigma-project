<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'username' => 'admin',
            'nama_lengkap' => 'admin',
            'email' => 'admin.sigma@gmail.com',
            'no_hp' => '081254789901',
            'password' => Hash::make('password'),
        ]);

        Admin::create([
            'username' => 'mentor',
            'nama_lengkap' => 'mentor',
            'email' => 'mentor.sigma@gmail.com',
            'no_hp' => '081254789911',
            'password' => Hash::make('password'),
        ]);
    }
}
