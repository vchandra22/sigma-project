<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create([
            'pertanyaan' => 'Apa itu SIGMA?',
            'slug' => 'apa-itu-sigma',
            'jawaban' => 'SIGMA tuh aplikasi keren banget yang dipakai buat ngatur kegiatan magang. Di situ ada fitur logbook buat catat kegiatan, tugas-tugas yang harus dikerjain, sertifikat, dan juga info-info penting di halaman utama.',
        ]);
        Faq::create([
            'pertanyaan' => 'Gimana caranya buat mendaftar aplikasi SIGMA?',
            'slug' => 'gimana-caranya-buat-mendaftar-aplikasi-sigma',
            'jawaban' => 'Buat dapet akses ke SIGMA, kamu tinggal daftar dulu sebagai pengguna dengan menekan tombol "Register" lalu isi form pendaftaran yang ada di aplikasi. Setelah daftar, admin bakal verifikasi akunmu dan kasih izin akses.',
        ]);
        Faq::create([
            'pertanyaan' => 'Apa gunanya logbook di SIGMA?',
            'slug' => 'apa-gunanya-logbook-di-sigma',
            'jawaban' => 'Logbook itu fitur buat kamu catet dan ngelacak kegiatan magangmu. Kamu bisa isi logbook dengan detail aktivitas harian, catatan penting, proyek yang lagi dikerjain, dan info lain yang penting.',
        ]);
        Faq::create([
            'pertanyaan' => 'Gimana cara pake fitur logbook di SIGMA?',
            'slug' => 'gimana-cara-pake-fitur-logbook-di-sigma',
            'jawaban' => 'Buat kamu yang sudah diterima untuk mengikuti kegiatan internship (magang), kamu tinggal login ke akunmu terus cari menu "Logbook". Klik menu itu buat buka formulir logbook. Isi semua info yang diminta, kayak tanggal, deskripsi kegiatan, arahan pembimbing dan kemajuan yang udah dicapai. Abis itu, simpen logbookmu.',
        ]);
        Faq::create([
            'pertanyaan' => 'Apa untungnya punya fitur tugas di SIGMA?',
            'slug' => 'apa-untungnya-punya-fitur-tugas-di-sigma',
            'jawaban' => 'Fitur tugas di SIGMA berguna banget buat liat tugas-tugas yang diberikan sama pembimbing magang atau orang lain yang terkait. Kamu bisa liat deskripsi tugas, deadline-nya, dan status penyelesaiannya.',
        ]);
        Faq::create([
            'pertanyaan' => 'Cara liat tugas (Assignment) yang ditugasin di SIGMA gimana ya?',
            'slug' => 'cara-liat-tugas-assignment-yang-ditugasin-di-sigma-gimana-ya',
            'jawaban' => 'Buat liat tugas-tugas yang ditugasin di SIGMA, login dulu ke akunmu terus cek menu "Assignment". Di situ, kamu bakal nemu daftar tugas yang ditugasin ke kamu beserta info lengkapnya.',
        ]);
        Faq::create([
            'pertanyaan' => 'Apa sih fitur sertifikat di SIGMA?',
            'slug' => 'apa-sih-fitur-sertifikat-di-sigma',
            'jawaban' => 'Fitur sertifikat di SIGMA memungkinkan kamu dapet pengakuan dan sertifikat buat kegiatan magang yang udah kamu selesaikan. Kamu bisa akses sertifikat elektronik yang otomatis dibuat berdasarkan catatan kegiatanmu di aplikasi.',
        ]);
        Faq::create([
            'pertanyaan' => 'Cara liat sertifikat di SIGMA gampang kok!',
            'slug' => 'cara-liat-sertifikat-di-sigma-gampang-kok',
            'jawaban' => 'Setelah kamu selesai magang dan status pada dashboard dinyatakan "Selesai", tinggal akses sertifikatnya pada menu "Profile" di SIGMA. Cari menu "Sertifikat" di aplikasi, trus klik "Unduh Sertifikat" buat liat sertifikat yang udah dibikin berdasarkan kegiatanmu. Kamu juga bisa download dan cetak sertifikatnya sesuai kebutuhan.',
        ]);
        Faq::create([
            'pertanyaan' => 'Apa aja yang bisa kamu dapet di halaman utama SIGMA?',
            'slug' => 'apa-aja-yang-bisa-kamu-dapet-di-halaman-utama-sigma',
            'jawaban' => 'Setelah kamu selesai magang dan status pada dashboard dinyatakan "Selesai", tinggal akses sertifikatnya pada menu "Profile" di SIGMA. Cari menu "Di halaman utama SIGMA, kamu bakal dapet info penting tentang program magang dan kegiatan terbaru. Ada posisi yang dibutuhkan instansi, berita terkini di tempat magang, info penting dari pengelola magang, dan update lainnya.',
        ]);
    }
}
