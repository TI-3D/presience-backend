<?php

namespace App\Services;

use App\Contracts\ScheduleContract;
use App\Http\Requests\GetScheduleByDateRequest;
use App\Http\Resources\ApiResource;
use App\Utils\WebResponseUtils;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
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
                return new ApiResource(true, 'No schedules found for today', []);
            }
            $result = $scheduleWeek->map(function ($schedule) use ($today, $attendances) {

                $attendanceForSchedule = $attendances->firstWhere('schedule_week_id', $schedule->sw_id);
                // dd($attendanceForSchedule);
                return [
                    "id" => $schedule->sw_id,
                    "date" => $schedule->date,
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


            return new ApiResource(true, 'Success', $result);
        } catch (Exception $e) {
            return WebResponseUtils::base(null, 'Failed to retrieve schedule', 500);
        }
    }

    public function getSchedule($today)
    {
        $groupId = Auth::user()->group_id;
        $scheduleWeek = DB::table('schedule_weeks as sw')
            ->join('schedules as s', 'sw.schedule_id', '=', 's.id')
            ->join('rooms as r', 's.room_id', '=', 'r.id')
            ->join('lecturers as l', 's.lecturer_id', '=', 'l.id')
            ->join('courses as c', 's.course_id', '=', 'c.id')
            ->join('weeks as w', 'sw.week_id', '=', 'w.id')
            ->where('sw.date', $today)
            ->where('s.group_id', $groupId)
            ->select('sw.*', 's.*', 'r.*', 'sw.id as sw_id', 'r.name as room_name', 'l.name as lecturer_name', 'c.*', 'c.name as course_name', 'w.*')
            ->get();
        return $scheduleWeek;
    }

    public function getScheduleById($id)
    {
        $groupId = Auth::user()->group_id;
        $scheduleWeek = DB::table('schedule_weeks as sw')
            ->join('schedules as s', 'sw.schedule_id', '=', 's.id')
            ->join('rooms as r', 's.room_id', '=', 'r.id')
            ->join('lecturers as l', 's.lecturer_id', '=', 'l.id')
            ->join('courses as c', 's.course_id', '=', 'c.id')
            ->join('weeks as w', 'sw.week_id', '=', 'w.id')
            ->where('sw.id', $id)
            ->where('s.group_id', $groupId)
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

    function getScheduleByDate(GetScheduleByDateRequest $request)
    {
        $user = Auth::user();
        $groupId = $user->group_id;
        $studentId = $user->id;

        try {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            if ($startDate && $endDate) {
                // Ambil data jadwal
                $scheduleWeek = DB::table('schedule_weeks as sw')
                    ->join('schedules as s', 'sw.schedule_id', '=', 's.id')
                    ->join('rooms as r', 's.room_id', '=', 'r.id')
                    ->join('lecturers as l', 's.lecturer_id', '=', 'l.id')
                    ->join('courses as c', 's.course_id', '=', 'c.id')
                    ->join('weeks as w', 'sw.week_id', '=', 'w.id')
                    ->where('s.group_id', $groupId)
                    ->whereBetween('sw.date', [$startDate, $endDate])
                    ->select('sw.*', 's.*', 'r.*', 'sw.id as sw_id', 'r.name as room_name', 'l.name as lecturer_name', 'c.*', 'c.name as course_name', 'w.*')
                    ->get();

                // Ambil data attendance
                $attendances = DB::table('attendances')
                    ->whereIn('schedule_week_id', $scheduleWeek->pluck('sw_id'))
                    ->where('student_id', $studentId)
                    ->get();

                // Map data jadwal dengan attendance
                $result = $scheduleWeek->map(function ($schedule) use ($attendances) {
                    $attendanceForSchedule = $attendances->firstWhere('schedule_week_id', $schedule->sw_id);

                    return [
                        "id" => $schedule->sw_id,
                        "date" => $schedule->date,
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
                                "time" => $schedule->time
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

                return new ApiResource(true, 'Success', $result);
            }
        } catch (Exception $e) {
            return WebResponseUtils::base(null, 'Failed to retrieve schedule', 500);

        }
    }

    public function getScheduleId()
    {
        $student = Auth::user();
        try {
            $schedules = DB::table('schedules as s')
                ->join('courses as c', 's.course_id', '=', 'c.id')
                ->join('groups as g','s.group_id','=', 'g.id')
                ->select('c.id as course_id', 'c.name as course_name', 'g.name as group_name')
                ->where('g.id', '=', $student->group_id)
                ->get();
            $result = $schedules->map(function ($schedule) {
                return [
                    "id" => $schedule->course_id,
                    "group_name" => $schedule->group_name,
                    "name" => $schedule->course_name
                ];
            });
            if ($result->isEmpty()) {
                return new ApiResource(true, 'Success', []);
            } else {
                return new ApiResource(true, 'Success', $result);
            }
        } catch (Exception $e) {
            return WebResponseUtils::base(null, 'Failed to retrieve courses', 500);
        }
    }
}
