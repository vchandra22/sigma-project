<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Document::create([
        //     'id' => '1',
        //     'user_id' => '1',
        //     'office_id' => '1',
        //     'position_id' => '1',
        //     'no_identitas' => '0003452642',
        //     'jurusan' => 'Jaringan Komputer',
        //     'instansi_asal' => 'SMKN 1 Kademangan',
        //     'u_tgl_mulai' => '2024-03-25',
        //     'u_tgl_selesai' => '2024-06-25',
        // ]);
        \App\Models\Document::factory(50)->create();

    }
}
