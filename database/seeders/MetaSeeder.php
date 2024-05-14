<?php

namespace Database\Seeders;

use App\Models\Meta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Meta::create([
            'page_name' => 'default',
            'slug' => 'default',
            'meta_title' => 'Lowongan Magang di Dinas Komunikasi Kota Blitar: Temukan Peluang Magang Menarik dengan SIGMA',
            'meta_description' => 'Temukan peluang magang menarik di Dinas Komunikasi Kota Blitar dengan SIGMA. Dapatkan pengalaman berharga dalam beragam kesempatan magang yang relevan.',
            'meta_keyword' => 'lowongan magang, magang kominfo kota blitar, informasi magang, pengembangan keterampilan, pkl kota blitar, pkl smk',
            'og_image' => 'nfOZ9Z7qe0V7UxUhops0.png',
        ]);

        Meta::create([
            'page_name' => 'home',
            'slug' => 'home',
            'meta_title' => 'Home',
            'meta_description' => 'Temukan peluang magang menarik di Dinas Komunikasi Kota Blitar dengan SIGMA. Dapatkan pengalaman berharga dalam beragam kesempatan magang yang relevan.',
            'meta_keyword' => 'lowongan magang, magang kominfo kota blitar, informasi magang, pengembangan keterampilan, pkl kota blitar, pkl smk',
            'og_image' => 'nfOZ9Z7qe0V7UxUhops0.png',
        ]);
    }
}
