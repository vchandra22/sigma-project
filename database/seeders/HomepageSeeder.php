<?php

namespace Database\Seeders;

use App\Models\Homepage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomepageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Homepage::create([
            'id' => '1',
            'heading' => 'Sistem Informasi Kegiatan Magang',
            'deskripsi_app' => 'Selamat datang di platform SIGMA, tempat di mana kesempatan menanti untukmu. Ayo kita eksplorasi beragam kegiatan magang yang sesuai dengan minat dan bakatmu,dengan proyek-proyek seru dan kamu dapat menjalin hubungan dengan para profesional berpengalaman. Yuk, kita bangun masa depan bareng. Gimana, tertarik jadi bagian dari perubahan?',
            'instagram_username' => 'application_sigma',
            'instagram_link' => 'https://www.instagram.com/application_sigma?igsh=MTV5ZTA1dXVmcHgybA==',
            'youtube_channel' => 'PemkotBlitar',
            'youtube_link' => 'https://www.youtube.com/@PemkotBlitarJatim',
            'id_video' => 'NliKw6e0id8',
            'alamat' => 'Jl. Dr. Moh. Hatta No.05, Sentul, Kec. Kepanjenkidul, Kota Blitar, Jawa Timur 66113.',
            'email' => 'diskominfotik@blitarkota.go.id',
            'no_telp' => '(0342) 807805',
            'gmaps_kantor' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15800.401683501328!2d112.1720179!3d-8.0912411!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78ec6a2320c57f%3A0x5466129e34187596!2sDinas%20Komunikasi%2C%20Informatika%20dan%20Statisitik%20Kota%20Blitar!5e0!3m2!1sen!2sid!4v1710001022757!5m2!1sen!2sid',
        ]);
    }
}
