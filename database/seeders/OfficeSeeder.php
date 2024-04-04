<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Office::create([
            'id' => '1',
            'nama_kantor' => 'Dinas Komunikasi Informatika dan Statistik Kota Blitar',
            'slug' => 'dinas-komunikasi-informatika-dan-statistik-kota-blitar',
            'alamat' => 'Jl. Dr. Moh. Hatta No.05, Sentul, Kec. Kepanjenkidul, Kota Blitar, Jawa Timur 66113',
            'nama_kepala' => 'Mujiono S.E, M.M',
            'nip_kepala' => '1198000023002'
        ]);
    }
}
