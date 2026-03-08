<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'username' => 'Admin',
            'full_name' => 'admin',
            'date_of_birth' => '2003-01-14',
            'gender' => 'male',
            'phone_number' => '0000000000',
            'email' => 'admin@gmail.com',
            'password' => 'admin@123',
            'role' => 'admin',
            'is_admin' => 'true',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
