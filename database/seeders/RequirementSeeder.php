<?php

namespace Database\Seeders;

use App\Models\Requirement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Requirement::create([
            'id' => '1',
            'content' => 'Mahasiswa aktif S1 (min.semester 6) atau D3 (min. semester 4) serta siswa siswi SMK',
        ]);
        Requirement::create([
            'id' => '2',
            'content' => 'Berkomitmen kerja penuh waktu (Senin-Jum’at dari 07.00 - 15.00) selama periode internship',
        ]);
        Requirement::create([
            'id' => '3',
            'content' => 'Mampu berkomunikasi dengan baik serta dapat bekerja dalam tim maupun mandiri',
        ]);
        Requirement::create([
            'id' => '4',
            'content' => 'Mentaati seluruh peraturan yang telah ditetapkan',
        ]);
    }
}
