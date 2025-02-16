<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'Admin User', 'email' => 'admin@example.com', 'password' => Hash::make('admin123'), 'role' => 'admin', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Employee One', 'email' => 'employee1@example.com', 'password' => Hash::make('employee123'), 'role' => 'employee', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
