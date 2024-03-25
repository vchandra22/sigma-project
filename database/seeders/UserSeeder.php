<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => '0003452642',
            'nama_lengkap' => 'Didik Harianto',
            'email' => 'didikharianto15@gmail.com',
            'no_hp' => '081234545567',
            'password' => Hash::make('password'),
        ]);
    }
}
