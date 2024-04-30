<?php

namespace Database\Seeders;

use App\Models\Benefit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Benefit::create([
            'id' => '1',
            'title' => 'Corporate Culture',
            'detail' => 'Implementasi budaya kerja perusahaan yakni Amanah, Kompeten, Harmonis, Loyal, Adaptif, dan Kolaboratif (AKHLAK).',
            'fa_icon' => 'fa-solid fa-users'
        ]);

        Benefit::create([
            'id' => '2',
            'title' => 'Final Assignment Project',
            'detail' => 'Berbagai use case dapat dijadikan sebagai topik Tugas Akhir (TA) dengan Supervisor sebagai pembimbing.',
            'fa_icon' => 'fa-solid fa-users'
        ]);

        Benefit::create([
            'id' => '3',
            'title' => 'Real Project Challenge',
            'detail' => 'Terjun langsung dalam use case nyata pada berbagai disiplin ilmu.',
            'fa_icon' => 'fa-solid fa-users'
        ]);

        Benefit::create([
            'id' => '4',
            'title' => 'Experience in Reputable Services',
            'detail' => 'Pengalaman internship di instansi terkemuka sebagai gerbang karir.',
            'fa_icon' => 'fa-solid fa-users'
        ]);
    }
}
