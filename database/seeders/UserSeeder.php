<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create(
            [
                'name' => 'Clinic Admin',
                'email' => 'admin@clinic.com',
                'password' => Hash::make('abc123'),
                'email_verified_at' => now(),
                'role' => 'admin',
            ]
        );
    }
}
