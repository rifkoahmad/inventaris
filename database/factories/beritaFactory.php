<?php

namespace Database\Factories;

use App\Models\Berita;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\berita>
 */
class beritaFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Berita::class;

    public function definition()
    {
        $tanggal = $this->faker->dateTimeBetween('2020-01-01', '2024-5-31')->format('Y-m-d');
        return [
            'kategori_beritas_id' => function () {
                return \App\Models\KategoriBerita::factory()->create()->id;
            },
            'judul' => $this->faker->sentence,
            'catatan' => $this->faker->paragraph,
            'gambar' => $this->faker->imageUrl(),
            'tanggal_publikasi' => $tanggal,
        ];
    }

}
