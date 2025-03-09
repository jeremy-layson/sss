<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => 'password', // automatically hashed by model cast
            'pseudonym' => 'admin',
            'role' => 'admin',
        ]);

        // Create 5 normal users
        for ($i = 1; $i <= 5; $i++) {
            $name = fake()->name();
            $pseudonym = fake()->unique()->userName();
            
            User::create([
                'name' => $name,
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => 'password', // automatically hashed by model cast
                'pseudonym' => $pseudonym,
                'role' => 'user',
            ]);
        }
    }
} 