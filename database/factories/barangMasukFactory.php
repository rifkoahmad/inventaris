<?php

namespace Database\Factories;

use App\Models\BarangMasuk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\barangMasuk>
 */
class barangMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = BarangMasuk::class;

    public function definition()
    {
        $tanggal = $this->faker->dateTimeBetween('2020-01-01', '2024-5-31')->format('Y-m-d');
        return [
            'barangs_id' => function () {
                return \App\Models\Barang::factory()->create()->id;
            },
            'suppliers_id' => function () {
                return \App\Models\Supplier::factory()->create()->id;
            },
            'jumlah_barang' => $this->faker->numberBetween(1, 100),
            'tanggal_masuk' => $tanggal,
        ];
    }
}
