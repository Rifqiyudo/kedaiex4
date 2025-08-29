<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
        [
            'name' => 'Admin',
            'email' => 'admin@kedai.com',
            'password' => Hash::make('Admin123!'),
            'role' => 'admin',
        ],[
            'name' => 'Barista',
            'email' => 'barista@kedai.com',
            'password' => Hash::make('Barista123!'),
            'role' => 'barista',
        ],[
            'name' => 'Pelanggan',
            'email' => 'pelanggan@kedai.com',
            'password' => Hash::make('Pelanggan123!'),
            'role' => 'pelanggan',
        ],]
    );
    }
}
