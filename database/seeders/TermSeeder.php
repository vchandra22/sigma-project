<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Term::create([
            'id' => '1',
            'content' => 'Kami percaya bahwa Kamu harus selalu tahu dan memiliki kontrol mengenai data apa yang Kami kumpulkan dari Kamu dan bagaimana Kami menggunakannya. Kebijakan Privasi ini menjelaskan bagaimana Kami menangani informasi yang Kamu berikan saat registrasi akun website sigma.blitarkota.go.id Dengan menyetujui kebijakan privasi ini, maka Kamu menyatakan bahwa data yang diberikan adalah benar dan Kamu menyetujui bahwa data tersebut dapat Kami gunakan untuk tujuan operasional akun sigma.blitarkota.go.id dan/atau tujuan lain yang Kami anggap pantas. Jika Kamu telah melakukan registrasi akun, Kamu dianggap telah menyetujui Kebijakan Privasi ini. Namun jika Kamu tidak menyetujui bagian apapun dari perjanjian ini, mohon agar tidak melanjutkan proses registrasi akun. Buatlah keputusan terbaik mengenai informasi yang Kamu bagikan kepada Kami.',
        ]);
    }
}
