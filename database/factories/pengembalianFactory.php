<?php

namespace Database\Factories;

use App\Models\Pegawai;
use App\Models\Pengembalian;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pengembalian>
 */
class pengembalianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pengembalian::class;

    public function definition()
    {
        $tanggalKembali = $this->faker->dateTimeBetween('2024-01-01', '2024-5-31')->format('Y-m-d');
        $pegawaiId = Pegawai::inRandomOrder()->first()->id;
        return [
            'peminjamen_id' => function () {
                return \App\Models\Peminjaman::factory()->create()->id;
            },
            'pegawais_id' => $pegawaiId,
            'tanggal_kembali' => $tanggalKembali,
        ];
    }
}
