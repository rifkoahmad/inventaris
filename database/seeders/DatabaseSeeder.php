<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Factories\beritaFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([RolesAndUsersSeeder::class,]);
        $this->call([PegawaisSeeder::class,]);
        $this->call([ProdisSeeder::class,]);
        $this->call([MahasiswasSeeder::class,]);
        $this->call([ruanganSeeder::class,]);
        $this->call([suplierSeeder::class,]);
        $this->call([barangSeeder::class,]);
        $this->call([peminjamanSeeder::class,]);
        $this->call([pengembalianSeeder::class,]);
        $this->call([barangMasukSeeder::class,]);
        $this->call([barangKeluarSeeder::class,]);
        $this->call([kategoriBeritaSeeder::class,]);
        $this->call([beritaSeeder::class,]);
    }
}
