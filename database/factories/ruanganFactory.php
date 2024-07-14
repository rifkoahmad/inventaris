<?php

namespace Database\Factories;

use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ruangan>
 */
class ruanganFactory extends Factory
{
    protected $model = Ruangan::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_ruangan' => $this->faker->word,
            'gedung' => $this->faker->word,
        ];
    }
}
