<?php

namespace App\Services;

use App\Contracts\ScheduleContract;
use App\Http\Resources\ApiResource;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleService implements ScheduleContract
{
    public function getScheduleForToday()
    {
        try {
            $today = Carbon::today()->format('Y-m-d');
            $scheduleWeek = $this->getSchedule($today);
            $attendances = $this->getAttendance($today);
            if ($scheduleWeek->isEmpty()) {
                throw new Exception("No schedules found for today.");
            }
            $result = $scheduleWeek->map(function ($schedule) use ($today, $attendances) {
                // dd($attendances);
                // dd($schedule->schedule_id);
                $attendanceForSchedule = $attendances->firstWhere('schedule_week_id', $schedule->sw_id);
                // dd($attendanceForSchedule);
                return [
                    "id" => $schedule->sw_id,
                    "date" => $today,
                    "is_online" => (bool)$schedule->is_online,
                    "status" => $schedule->status,
                    "opened_at" => $schedule->opened_at,
                    "closed_at" => $schedule->closed_at,
                    "schedule" => [
                        "id" => $schedule->schedule_id,
                        "day" => $schedule->day,
                        "start_time" => Carbon::parse($schedule->start_time)->format('H:i'),
                        "end_time" => Carbon::parse($schedule->end_time)->format('H:i'),
                        "week" => [
                            "id" => $schedule->week_id,
                            "name" => $schedule->name,
                            "start_date" => $schedule->start_date,
                            "end_date" => $schedule->end_date,
                        ],
                        "room" => [
                            "id" => $schedule->room_id,
                            "name" => $schedule->room_name,
                            "floor" => $schedule->floor,
                            "latitude" => $schedule->latitude,
                            "longitude" => $schedule->longitude,
                        ],
                        "lecturer" => [
                            "id" => $schedule->lecturer_id,
                            "name" => $schedule->lecturer_name,
                        ],
                        "course" => [
                            "id" => $schedule->course_id,
                            "name" => $schedule->course_name,
                            "sks" => $schedule->sks,
                            "time" =>
                            $schedule->time
                        ],
                    ],
                    "attendance" => $attendanceForSchedule ? [
                        "id" => $attendanceForSchedule->id,
                        "sakit" => $attendanceForSchedule->sakit,
                        "izin" => $attendanceForSchedule->izin,
                        "alpha" => $attendanceForSchedule->alpha,
                        "entry_time" => Carbon::parse($attendanceForSchedule->entry_time)->format('H:i:s'),
                        "is_changed" => (bool)$attendanceForSchedule->is_changed,
                        "lecturer_verified" => (bool) $attendanceForSchedule->lecturer_verified,
                    ] : null,
                ];
            });


            if ($attendances->isEmpty()) {
                $resultAttendance = [];
            } else {
                $resultAttendance = $attendances->map(function ($attendance) use ($today) {
                    $attendance->entry_time = Carbon::parse($attendance->entry_time)->format('H:i:s');
                    return [
                        "attendance" => [
                            "id" => $attendance->id,
                            "sakit" => $attendance->sakit,
                            "izin" => $attendance->izin,
                            "alpha" => $attendance->alpha,
                            "entry_time" => $attendance->entry_time,
                            "is_changed" => $attendance->is_changed,
                            "lecturer_verified" => $attendance->lecturer_verified,
                        ],
                    ];
                });
            }
            // $response = [
            //     'schedules' => $result,
            //     'attendances' => $resultAttendance
            // ];

            return new ApiResource(true, 'Success', $result);
        } catch (Exception $e) {
            return new ApiResource(false, 'Failed to retrieve schedule', []);
        }
    }

    public function getSchedule($today)
    {
        $scheduleWeek = DB::table('schedule_weeks as sw')
            ->join('schedules as s', 'sw.schedule_id', '=', 's.id')
            ->join('rooms as r', 's.room_id', '=', 'r.id')
            ->join('lecturers as l', 's.lecturer_id', '=', 'l.id')
            ->join('courses as c', 's.course_id', '=', 'c.id')
            ->join('weeks as w', 'sw.week_id', '=', 'w.id')
            ->where('sw.date', $today)
            ->select('sw.*', 's.*', 'r.*', 'sw.id as sw_id', 'r.name as room_name', 'l.name as lecturer_name', 'c.*', 'c.name as course_name', 'w.*')
            ->get();
        return $scheduleWeek;
    }

    public function getScheduleById(array $id)
    {
        $scheduleWeek = DB::table('schedule_weeks as sw')
            ->join('schedules as s', 'sw.schedule_id', '=', 's.id')
            ->join('rooms as r', 's.room_id', '=', 'r.id')
            ->join('lecturers as l', 's.lecturer_id', '=', 'l.id')
            ->join('courses as c', 's.course_id', '=', 'c.id')
            ->join('weeks as w', 'sw.week_id', '=', 'w.id')
            ->whereIn('sw.id', $id)
            ->select('sw.*', 's.*', 'r.*', 'sw.id as sw_id', 'r.name as room_name', 'l.name as lecturer_name', 'c.*', 'c.name as course_name', 'w.*')
            ->first();
        return $scheduleWeek;
    }

    public function getAttendance($today)
    {
        $attendance = DB::table('attendances')
            ->where('student_id', Auth::id())
            ->whereDate('entry_time', $today)
            ->select('id', 'sakit', 'izin', 'alpha', 'entry_time', 'schedule_week_id', 'is_changed', 'lecturer_verified')
            ->get();
        return $attendance;
    }
}
