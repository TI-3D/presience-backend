<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\ScheduleWeek;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function PHPUnit\Framework\isFalse;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::whereNotNull('group_id')->get();

        foreach ($students as $student) {
            $schedules = Schedule::where('group_id', $student->group_id)
                ->get(['id', 'start_time']);

            foreach ($schedules as $schedule) {
                $scheduleWeeks = ScheduleWeek::where('schedule_id', $schedule->id)
                    ->where('week_id', '<', 14) // Hanya untuk minggu < 14
                    ->get();

                foreach ($scheduleWeeks as $scheduleWeek) {
                    // Insert data ke tabel attendance
                    Attendance::insert([
                        'sakit' => 0, 
                        'izin' => 0, 
                        'alpha' => 0, 
                        // 'entry_time' => $schedule->start_time, // Gunakan start_at dari schedule
                        'is_changed' => false, 
                        'lecturer_verified' => true,
                        'student_id' => $student->id, 
                        'schedule_week_id' => $scheduleWeek->id, 
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
