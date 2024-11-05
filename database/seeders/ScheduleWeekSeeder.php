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
        $startDates = [
            1 => '2024-08-26',
            2 => '2024-08-27',
            3 => '2024-08-27',
            4 => '2024-08-28',
            5 => '2024-08-29',
            6 => '2024-08-30',
            7 => '2024-08-30',
        ];

        $data = [];
        $today = Carbon::today();

        for ($week = 1; $week <= 17; $week++) {
            foreach ($startDates as $scheduleId => $date) {
                $newDate = Carbon::parse($date)->addWeeks($week - 1);
                if ($newDate->isSameDay($today)) {
                    $status = 'closed';
                    $openedAt = now()->format('H:i:s');
                } else {
                    $status =  'closed';
                    $openedAt =  null;
                }

                $data[] = [
                    'date' => $newDate->format('Y-m-d'),
                    'is_online' => false,
                    'status' => $status,
                    'opened_at' => $openedAt,
                    'week_id' => $week,
                    'schedule_id' => $scheduleId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('schedule_weeks')->insert($data);

        DB::table('schedule_weeks')->insert([
            //  Make test available every day eventho saturday and sunday for development
            [
                'date' =>  Carbon::today()->format('Y-m-d'),
                'is_online' => false,
                'status' => 'opened',
                'opened_at' => now(),
                'week_id' => 1,
                'schedule_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
