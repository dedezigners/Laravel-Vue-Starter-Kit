<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@dedezigners.com',
            'password' => 'password',
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);
        
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'username' => 'test',
            'email' => 'test@dedezigners.com',
            'email_verified_at' => now(),
            'password' => 'password'
        ]);
    }
}
