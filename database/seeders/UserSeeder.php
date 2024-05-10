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
        // User::create([
        //     'id' => '1',
        //     'username' => '0003452642',
        //     'nama_lengkap' => 'Ridwan Budianto',
        //     'jenis_kelamin' => 'Laki - Laki',
        //     'email' => 'ridwan.budianto788@gmail.com',
        //     'no_hp' => '081254789941',
        //     'password' => Hash::make('password'),
        // ]);

        \App\Models\User::factory(5)->create();
    }
}
