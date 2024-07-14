<?php

namespace Database\Factories;

use App\Models\Pegawai;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\peminjaman>
 */
class peminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Peminjaman::class;

    public function definition()
    {
        $userId = User::inRandomOrder()->first()->id;
        $pegawaiId = Pegawai::inRandomOrder()->first()->id;
        $tanggal = $this->faker->dateTimeBetween('2024-01-01', '2024-5-31')->format('Y-m-d');
        return [
            'users_id' => $userId,
            'barangs_id' => \App\Models\Barang::factory()->create()->id,
            'pegawais_id' => $pegawaiId,
            'jumlah' => $this->faker->numberBetween(1, 10),
            'tanggal_pinjam' => $tanggal,
            'lama_pinjam' => $this->faker->randomElement(['1 hari', '2 hari', '3 hari']),
        ];
    }
}
