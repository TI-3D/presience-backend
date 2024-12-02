<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\ScheduleWeek;
use App\Models\User;
use App\Models\Week;
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

        $alphaSP1 = 55;

        foreach ($students as $student) {
            $schedules = Schedule::where('group_id', $student->group_id)
                ->with('course')
                ->get(['id', 'start_time', 'course_id']);

            foreach ($schedules as $schedule) {
                $scheduleWeeks = ScheduleWeek::where('schedule_id', $schedule->id)
                    // ->where('week_id', '<', $currentWeek) // Hanya untuk minggu < 14
                    ->where('date', '<', now()->toDateString())
                    ->get();

                foreach ($scheduleWeeks as $scheduleWeek) {
                    // Insert data ke tabel attendance
                    // dd($schedule->course->time);
                    Attendance::insert([
                        'sakit' => 0,
                        'izin' => 0,
                        'alpha' => $student->id == 1 && $alphaSP1 > 0 ? $schedule->course->time : 0,
                        // 'entry_time' => $schedule->start_time, // Gunakan start_at dari schedule
                        'is_changed' => false,
                        'lecturer_verified' => true,
                        'student_id' => $student->id,
                        'schedule_week_id' => $scheduleWeek->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    if ($student->id == 1 && $alphaSP1 > 0) {
                        $alphaSP1 -= $schedule->course->time;
                    }
                }
            }
        }
    }
}
