<?php

namespace Database\Factories;

use App\Models\KategoriBerita;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\kategoriBerita>
 */
class kategoriBeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = KategoriBerita::class;

    public function definition()
    {
        $nama = $this->faker->unique()->word;

        return [
            'nama' => $nama,
            'slug' => Str::slug($nama),
        ];
    }
}
