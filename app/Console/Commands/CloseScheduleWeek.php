<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CloseScheduleWeek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CloseScheduleWeek';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To close schedulee week and add alpha for student do not presence';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            Log::info("Schedule run");
            $today = Carbon::today()->format('Y-m-d');
            $scheduleWeeks = DB::table('schedule_weeks as sw')
                ->join('schedules as s', 'sw.schedule_id', '=', 's.id')
                ->join('rooms as r', 's.room_id', '=', 'r.id')
                ->join('lecturers as l', 's.lecturer_id', '=', 'l.id')
                ->join('courses as c', 's.course_id', '=', 'c.id')
                ->join('weeks as w', 'sw.week_id', '=', 'w.id')
                ->where('sw.date', $today)
                ->select('sw.*', 's.*', 'r.*', 'sw.id as sw_id', 'r.name as room_name', 'l.name as lecturer_name', 'c.*', 'c.name as course_name', 'w.*')
                ->get();
            $scheduleWeeks->each(function ($schedule) {
                $students = DB::table('schedule_weeks as sw')
                    ->join('schedules as s', 'sw.schedule_id', '=', 's.id')
                    ->join('groups as g', 's.group_id', '=', 'g.id')
                    ->join('users as u', 'g.id', '=', 'u.group_id')
                    ->where('sw.id', $schedule->sw_id)
                    ->select('*')
                    ->get();
                $endTime = Carbon::parse($schedule->end_time);
                $openedTime = Carbon::parse($schedule->opened_at);
                $isScheduleClosed = false;
                    if ($schedule->status == 'opened') {
                        if ($openedTime->gt($endTime) && $openedTime->diffInMinutes(Carbon::now()) > 15) { // check if opened after end time and more than 15 minutes
                            $isScheduleClosed = true;
                        } else if (Carbon::now()->gte($endTime)&& $openedTime->lt($endTime)) { // check if opened before end time (same time with schedule)
                            $isScheduleClosed = true;
                        }
                    }

                    if ($isScheduleClosed) {
                        DB::table('schedule_weeks')
                            ->where('id', $schedule->sw_id)
                            ->update([
                                'status' => 'closed',
                                'closed_at' => now(),
                            ]);
                        $this->info("Schedule week ID {$schedule->sw_id} has been closed");
                        $students->each(function ($student) use ($schedule) {
                            $count = $this->searchAttendance($student, $schedule);
                            if ($count == 0) {
                                $this->createAlphaAttendance($schedule->time, $student->id, $schedule->sw_id);
                            } else {
                                return $this->info("Student id {$student->id} already present");
                            }
                        });
                    }
            });
            $this->info("Closed schedule weeks where end time has passed");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function searchAttendance($student, $schedule)
    {
        $count = DB::table('attendances')
            ->where('student_id', $student->id)
            ->where('schedule_week_id', $schedule->sw_id)
            ->exists();

        if ($count) {
            DB::table('attendances')
                ->where('student_id', $student->id)
                ->where('schedule_week_id', $schedule->sw_id)
                ->where('sakit', 0)
                ->where('izin', 0)
                ->update(['lecturer_verified' => true]);
        }
        return $count;
    }

    public function createAlphaAttendance($time, $id, $sw_id)
    {
        $attendanceId = DB::table('attendances')->insert([
            'alpha' => $time,
            'sakit' => 0,
            'izin' => 0,
            'student_id' => $id,
            'schedule_week_id' => $sw_id,
            'entry_time' => now(),
            'lecturer_verified' => true
        ]);

        return $this->info("Attendances student id {$id} has been added.");
    }
}
