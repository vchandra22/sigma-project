<?php

namespace Database\Seeders;

use App\Models\Journey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JourneySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Journey::create([
            'id' => 1,
            'title' => 'Registration',
            'detail' => 'Kamu harus melakukan pendaftaran Internship dengan melengkapi form pendaftaran pada menu “Register”',
        ]);
        Journey::create([
            'id' => 2,
            'title' => 'Administration',
            'detail' => 'Kamu harus melengkapi data diri dan submit CV (bagi siswa SMK) / Proposal Penelitian (bagi mahasiswa) pada saat seleksi Administrasi.',
        ]);
        Journey::create([
            'id' => 3,
            'title' => 'Review',
            'detail' => 'Semua pendaftar yang telah selesai melakukan proses administrasi akan di review oleh Instansi yang dituju. Jika lulus, kamu akan melakukan On Job sesuai dengan Internship Role selama periode yang diajukan.',
        ]);
        Journey::create([
            'id' => 4,
            'title' => 'On Job',
            'detail' => 'Kegiatan Internship akan di dampingi oleh pembimbing lapang, kamu bisa mengisi logbook kegiatan selama periode Internship yang diajukan',
        ]);
        Journey::create([
            'id' => 5,
            'title' => 'Graduate',
            'detail' => 'Jika berhasil menyelesaikan On Job sesuai dengan periode yang ditetapkan, Kamu akan dinyatakan lulus serta berhak mendapatkan sertifikat magang yang disahkan oleh instansi terkait',
        ]);
    }
}
