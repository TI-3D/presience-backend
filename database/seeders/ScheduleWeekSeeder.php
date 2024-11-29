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
        $schedules = DB::table('schedules')->get(); // Data jadwal
        $weeks = DB::table('weeks')->get(); // Data minggu
        $daysMap = [
            'monday'    => 0,
            'tuesday'   => 1,
            'wednesday' => 2,
            'thursday'  => 3,
            'friday'    => 4,
            // 'Saturday'  => 5,
            // 'Sunday'    => 6,
        ];

        $startOfSemester = Carbon::parse($weeks[0]->start_date);

        $data = [];

        foreach ($weeks as $week) {
            foreach ($schedules as $schedule) {
                $scheduleDay = $schedule->day; // Hari pada jadwal, misal "Monday"
                if (!isset($daysMap[$scheduleDay])) {
                    continue; // Lewati jika hari tidak valid
                }

                // Hitung tanggal berdasarkan hari jadwal
                $scheduleDayIndex = $daysMap[$scheduleDay];
                $startDayIndex = $startOfSemester->dayOfWeek; // Day index for Monday (0)
                $dayDate = $startOfSemester->copy()->addDays($scheduleDayIndex);

                // Tambahkan jumlah minggu berdasarkan week_id
                $dateForWeek = $dayDate->addWeeks($week->id - 1);

                $data[] = [
                    'date' => $dateForWeek->format('Y-m-d'),
                    'is_online' => false,
                    'status' => 'closed',
                    'opened_at' => null,
                    'week_id' => $week->id,
                    'schedule_id' => $schedule->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert data ke tabel schedule_weeks
        DB::table('schedule_weeks')->insert($data);
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
