<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Work;
use App\Models\Rating;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the UserSeeder to create users
        $this->call(UserSeeder::class);
    }
}
