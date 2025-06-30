<?php

namespace Database\Seeders;

use App\Models\User;
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
        // User::factory(10)->create();

        

        User::updateOrCreate([
            'email' => 'admin@kedai.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::updateOrCreate([
            'email' => 'barista@kedai.com',
        ], [
            'name' => 'Barista 1',
            'password' => Hash::make('barista123'),
            'role' => 'barista',
        ]);
    }
}
