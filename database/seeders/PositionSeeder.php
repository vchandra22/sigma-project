<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::create([
            'role' => 'Developer',
            'slug' => 'developer',
            'deskripsi' => 'Front End, Back End, Document Engineer, Quality Assurance (Web Mobile for iOS/Android)',
            'jobdesk' => 'jobdesk list',
            'requirement' => 'Memahami bahasa pemograman seperti Java Script, React JS, Node JS, dll',
            'gambar' => NULL,
        ]);
    }
}
