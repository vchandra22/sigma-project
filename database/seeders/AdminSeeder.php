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
            'id' => '1',
            'office_id' => '1',
            'username' => 'admin',
            'nama_lengkap' => 'Eko Wahyudi S.E',
            'nip' => '8870003201',
            'jenis_kelamin' => 'Laki - Laki',
            'email' => 'admin.sigma@gmail.com',
            'no_hp' => '081254789901',
            'password' => Hash::make('password'),
        ]);

        Admin::create([
            'id' => '2',
            'office_id' => '1',
            'username' => 'mentor',
            'nama_lengkap' => 'Ardi Priyatna S.Kom',
            'nip' => '8870003301',
            'jenis_kelamin' => 'Laki - Laki',
            'email' => 'mentor.sigma@gmail.com',
            'no_hp' => '081254789911',
            'password' => Hash::make('password'),
        ]);
    }
}
