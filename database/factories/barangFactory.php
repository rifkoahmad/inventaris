<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\barang>
 */
class barangFactory extends Factory
{
    protected $model = Barang::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ruanganIds = Ruangan::pluck('id')->toArray();
        $kode_barang = Str::random(10);
        return [
            'ruangans_id' => $this->faker->randomElement($ruanganIds),
            'nama_barang' => $this->faker->word,
            'kode_barang' => $kode_barang,
            'stok' => $this->faker->numberBetween(1, 100),
            'foto' => null, // Misalnya tidak ada default foto
            'status' => $this->faker->randomElement(['aktif', 'tidak aktif']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
