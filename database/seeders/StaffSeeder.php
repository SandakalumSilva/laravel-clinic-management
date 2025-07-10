<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $staff = [
            [
                'name' => 'Dr. John Doe',
                'email' => 'doctor@clinic.com',
                'role' => 'doctor',
                'specialization' => 'Cardiologist',
            ],
            [
                'name' => 'Nurse Mary',
                'email' => 'nurse@clinic.com',
                'role' => 'nurse',
            ],
            [
                'name' => 'Cashier Tom',
                'email' => 'cashier@clinic.com',
                'role' => 'cashier',
            ],
            [
                'name' => 'Receptionist Jane',
                'email' => 'reception@clinic.com',
                'role' => 'receptionist',
            ],
        ];

        foreach ($staff as $member) {
            User::create([
                'name' => $member['name'],
                'email' => $member['email'],
                'phone' => fake()->phoneNumber(),
                'password' => Hash::make('password'),
                'role' => $member['role'],
                'specialization' => $member['specialization'] ?? null,
                
            ]);
        }
    }
}
