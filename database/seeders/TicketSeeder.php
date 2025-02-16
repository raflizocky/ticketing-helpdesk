<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tickets')->insert([
            ['subject' => 'Issue with Laptop', 'description' => 'Laptop not starting.', 'priority' => 'Urgent', 'status' => 'Open', 'department_id' => 1, 'created_by' => 1, 'assigned_to' => 2, 'due_date' => now()->addDays(2), 'created_at' => now(), 'updated_at' => now()],
            ['subject' => 'Payroll Issue', 'description' => 'Salary not credited.', 'priority' => 'Middle', 'status' => 'In Progress', 'department_id' => 3, 'created_by' => 2, 'assigned_to' => 1, 'due_date' => now()->addDays(3), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
