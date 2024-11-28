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
        $schedules = DB::table('schedules')->get();
        $weeks = DB::table('weeks')->get(); 

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

        foreach ($weeks as $week) {
            foreach ($schedules as $schedule) {

                $baseDate = $startDates[$schedule->id] ?? $today->format('Y-m-d');
                $newDate = Carbon::parse($baseDate)->addWeeks($week->id - 1);

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
                    'week_id' => $week->id,
                    'schedule_id' => $schedule->id,
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
                'status' => 'closed',
                'opened_at' => null,
                'week_id' => 1,
                'schedule_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
