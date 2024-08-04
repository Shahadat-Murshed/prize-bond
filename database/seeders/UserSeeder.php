<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Shahadat Murshed',
            'email' => 'shahadat.murshed@gmail.com',
            'password' => bcrypt('2747872@'),
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
