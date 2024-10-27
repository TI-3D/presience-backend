<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('schedule_weeks')->insert([
                [
                    'date' => '2024-10-21',
                    'is_online' => false,
                    'status' => 'closed',
                    'opened_at' => null,
                    'week_id' => 1,
                    'schedule_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'date' => '2024-10-22',
                    'is_online' => false,
                    'status' => 'closed',
                    'opened_at' => null,
                    'week_id' => 1,
                    'schedule_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'date' => '2024-10-22',
                    'is_online' => false,
                    'status' => 'closed',
                    'opened_at' => null,
                    'week_id' => 1,
                    'schedule_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'date' => '2024-10-23',
                    'is_online' => false,
                    'status' => 'closed',
                    'opened_at' => null,
                    'week_id' => 1,
                    'schedule_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'date' => '2024-10-24',
                    'is_online' => false,
                    'status' => 'closed',
                    'opened_at' => null,
                    'week_id' => 1,
                    'schedule_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'date' => '2024-10-25',
                    'is_online' => false,
                    'status' => 'closed',
                    'opened_at' => null,
                    'week_id' => 1,
                    'schedule_id' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'date' => '2024-10-27',
                    'is_online' => false,
                    'status' => 'closed',
                    'opened_at' =>now(),
                    'week_id' => 1,
                    'schedule_id' => 7,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }

