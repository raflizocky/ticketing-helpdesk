<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketRepliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ticket_replies')->insert([
            ['ticket_id' => 1, 'user_id' => 2, 'message' => 'Please try restarting your laptop.', 'created_at' => now(), 'updated_at' => now()],
            ['ticket_id' => 2, 'user_id' => 1, 'message' => 'We are checking with finance.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
