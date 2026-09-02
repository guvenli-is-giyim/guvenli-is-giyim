<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin panel login account.
        // Email: admin@guvenlisis.com — Şifre: password
        // Not: Canlıya almadan önce bu şifreyi mutlaka değiştirin.
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@guvenlisis.com',
        ]);
    }
}
