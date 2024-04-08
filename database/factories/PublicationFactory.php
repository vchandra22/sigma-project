<?php

namespace Database\Factories;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PublicationFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Publication::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $title = $this->faker->sentence;
        $slug = Str::slug($title, '-');

        return [
            'uuid' => $this->faker->uuid,
            'judul' => $title,
            'slug' => $slug,
            'content' => $this->faker->paragraph(4, true),
            'gambar' => NULL,
        ];
    }
}
