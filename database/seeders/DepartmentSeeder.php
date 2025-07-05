<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'General Medicine',
            'Pediatrics',
            'Cardiology',
            'Dermatology',
            'Gynecology',
            'Orthopedics',
            'Neurology',
            'ENT (Ear, Nose, Throat)',
            'Urology',
            'Psychiatry',
        ];

        foreach ($departments as $dept) {
            DB::table('departments')->insert([
                'name' => $dept,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
