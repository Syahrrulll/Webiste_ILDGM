<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus komentar ini jika Anda ingin membuat user dummy saat seeding
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('password')
        // ]);

        // Panggil BadgeSeeder (PENTING)
        $this->call(BadgeSeeder::class);
    }
}
