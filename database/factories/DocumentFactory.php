<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Document;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $commonIdentifier = '0003452641'; // Starting value for both username and no_identitas

        $commonIdentifier++; // Increment the common identifier
        static $id = 1;

        return [
            'uuid' => $this->faker->uuid,
            'user_id' => $id++,
            'office_id' => 1,
            'position_id' => $this->faker->numberBetween(1, 4),
            'no_identitas' => $commonIdentifier,
            'jurusan' => $this->faker->randomElement(['Rekayasa Perangkat Lunak', 'Manajemen', 'Jaringan Komputer', 'Administrasi Perkantoran']),
            'instansi_asal' => 'SMKN 1 Blitar',
            'nama_pembimbing' => $this->faker->name,
            'no_hp_pembimbing' => '08' . $this->faker->numerify('##########'),
            'u_tgl_mulai' => $this->faker->dateTimeBetween('+0 days', '+1 month'),
            'u_tgl_selesai' => $this->faker->dateTimeBetween('+2 month', '+6 month'),
            'e_tgl_mulai' => NULL,
            'e_tgl_selesai' => NULL,
            'doc_pengantar' => '5B10Kc5bZPbNEueQyd6e.pdf',
            'doc_kesbang' => NULL,
            'doc_proposal' => NULL,
            'doc_laporan' => NULL,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
