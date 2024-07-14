<?php

namespace Database\Factories;

use App\Models\BarangKeluar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\barangKeluar>
 */
class barangKeluarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = BarangKeluar::class;

    public function definition()
    {
        $userId = User::inRandomOrder()->first()->id;
        return [
            'users_id' => $userId,
            'tanggal_keluar' => $this->faker->date(),
        ];
    }
}
