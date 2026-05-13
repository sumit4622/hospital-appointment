<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $departments = [
            ['name' => 'Cardiology'],
            ['name' => 'Dermatology'],
            ['name' => 'Pediatrics'],
            ['name' => 'Neurology'],
            ['name' => 'Orthopedics'],
        ];

        foreach ($departments as $dept) {
            Department::updateOrCreate(['name' => $dept['name']], $dept);
        }
    }
}
