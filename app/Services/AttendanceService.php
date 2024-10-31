<?php

namespace App\Services;

use App\Contracts\AttendanceContract;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Resources\ApiResource;
use App\Services\PermitService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceService implements AttendanceContract
{
    protected $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }
    function validationAttendance(Request $request)
    {
        return true;
    }


    function storeAttendance(StoreAttendanceRequest $request)
    {
        try {
            $student_id = Auth::id();
            $today = Carbon::today()->format('Y-m-d');
            $scheduleWeek = $this->scheduleService->getScheduleById([$request->sw_id]);
            if (!$scheduleWeek) {
                throw new Exception("No schedules found for today.");
            }
            if (!$scheduleWeek->opened_at || $scheduleWeek->closed_at) {
                throw new Exception("Attendance not available.");
            }
            $currentTime = Carbon::now();
            $openedAt = Carbon::parse($scheduleWeek->opened_at);
            $late = $this->lateCheck($currentTime, $openedAt, $scheduleWeek->time);
            // Create attendance data if the student are not on time
            if ($late > 0) {
                // If students are late and fill out the permission form
                if ($request->has('description') && $request->hasFile('evidence')) {
                    $newAttendance = $this->createAttendance($student_id, $scheduleWeek, $late, 0, 0, $currentTime);
                    $image = $request->file('evidence');
                    $cloudinaryImage = $image->storeOnCloudinary('evidence');
                    $permit = DB::table('permits')->insertGetId([
                        'start_date' => $today,
                        'end_date' => $today,
                        'type_permit' => 'izin',
                        'description' => $request->description,
                        'evidence' => $cloudinaryImage->getSecurePath(),
                        'image_public_id' => $cloudinaryImage->getPublicId(),
                        'student_id' => $student_id
                    ]);
                    $permitDetail = DB::table('permit_details')->insert([
                        'permit_id' => $permit,
                        'schedule_week_id' => $scheduleWeek->sw_id,
                    ]);
                } else {
                    // If students are late and fill out the permission form
                    $newAttendance = $this->createAttendance($student_id, $scheduleWeek, $late, 0, 0, $currentTime);
                }
            } else {
                // Create attendance data if the student on time
                $newAttendance = $this->createAttendance($student_id, $scheduleWeek, $late, 0, 0, $currentTime);
            }
            $data = $this->prepareAttendanceData($scheduleWeek, $newAttendance);
            return new ApiResource(true, 'Success', $data);
        } catch (Exception $e) {
            return new ApiResource(false, 'Failed to do attendance', $e->getMessage());
        }
    }

    public function createAttendance($student_id, $scheduleWeek, $alpha, $sick, $permit, $currentTime)
    {
        $attendanceId = DB::table('attendances')->insertGetId([
            'alpha' => $alpha,
            'sakit' => $sick,
            'izin' => $permit,
            'student_id' => $student_id,
            'schedule_week_id' => $scheduleWeek->sw_id,
            'entry_time' => $currentTime,
        ]);

        return DB::table('attendances')->where('id', $attendanceId)->first();
    }

    function lateCheck($currentTime, $openedAt, $hours)
    {
        $minutesLate = $openedAt->diffInMinutes($currentTime);
        if ($minutesLate <= 15) {
            $alpha = 0;
        } elseif ($minutesLate > 15 && $minutesLate <= 50) {
            $alpha = 1;
        } elseif ($minutesLate > 50 && $minutesLate <= 100) {
            $alpha = 2;
        } elseif ($minutesLate > 100 && $minutesLate <= 150) {
            $alpha = 3;
        } elseif ($minutesLate > 150 && $minutesLate <= 200) {
            $alpha = 4;
        } elseif ($minutesLate > 200 && $minutesLate <= 250) {
            $alpha = 5;
        } else {
            $alpha = $hours;
        }
        return $alpha;
    }

    public function prepareAttendanceData($scheduleWeek, $newAttendance)
    {
        try {
            $today = Carbon::today()->format('Y-m-d');
            $data = [
                "id" => $scheduleWeek->sw_id,
                "date" => $today,
                "is_online" => (bool)$scheduleWeek->is_online,
                "status" => $scheduleWeek->status,
                "opened_at" => $scheduleWeek->opened_at,
                "closed_at" => $scheduleWeek->closed_at,
                "schedule" => [
                    "id" => $scheduleWeek->schedule_id,
                    "day" => $scheduleWeek->day,
                    "start_time" => Carbon::parse($scheduleWeek->start_time)->format('H:i'),
                    "end_time" => Carbon::parse($scheduleWeek->end_time)->format('H:i'),
                    "week" => [
                        "id" => $scheduleWeek->week_id,
                        "name" => $scheduleWeek->name,
                        "start_date" => $scheduleWeek->start_date,
                        "end_date" => $scheduleWeek->end_date,
                    ],
                    "room" => [
                        "id" => $scheduleWeek->room_id,
                        "name" => $scheduleWeek->room_name,
                        "floor" => $scheduleWeek->floor,
                        "latitude" => $scheduleWeek->latitude,
                        "longitude" => $scheduleWeek->longitude,
                    ],
                    "lecturer" => [
                        "id" => $scheduleWeek->lecturer_id,
                        "name" => $scheduleWeek->lecturer_name,
                    ],
                    "course" => [
                        "id" => $scheduleWeek->course_id,
                        "name" => $scheduleWeek->course_name,
                        "sks" => $scheduleWeek->sks,
                        "time" => $scheduleWeek->time
                    ]
                ],
                "attendance" =>  [
                    "id" => $newAttendance->id,
                    "sakit" => $newAttendance->sakit,
                    "izin" => $newAttendance->izin,
                    "alpha" => $newAttendance->alpha,
                    "entry_time" => Carbon::parse($newAttendance->entry_time)->format('H:i:s'),
                    "is_changed" => (bool)$newAttendance->is_changed,
                    "lecturer_verified" => (bool) $newAttendance->lecturer_verified,
                ]
            ];

            return $data;
        } catch (Exception $e) {
            return new ApiResource(false, 'Failed to get attendance data', $e->getMessage());
        }
    }

    public function getAttendanceHistoryByStudent()
    {
        try {
            $student_id = Auth::id();
            $currentDate = Carbon::today()->format('Y-m-d');

            $currentWeek = DB::table('weeks')
                ->where('start_date', '<=', $currentDate)
                ->where('end_date', '>=', $currentDate)
                ->first();

            if (!$currentWeek) {
                throw new Exception("No current week found.");
            }

            $attendanceHistory = DB::table('attendances as a')
                ->join('schedule_weeks as sw', 'a.schedule_week_id', '=', 'sw.id')
                ->join('schedules as s', 'sw.schedule_id', '=', 's.id')
                ->join('rooms as r', 's.room_id', '=', 'r.id')
                ->join('lecturers as l', 's.lecturer_id', '=', 'l.id')
                ->join('courses as c', 's.course_id', '=', 'c.id')
                ->join('weeks as w', 'sw.week_id', '=', 'w.id')
                ->select('sw.*', 's.*', 'r.*', 'sw.id as sw_id', 'a.*', 'a.id as attendance_id', 'r.name as room_name', 'l.name as lecturer_name', 'c.*', 'c.name as course_name', 'w.*')
                ->where('a.student_id', $student_id)
                ->whereBetween('sw.date', [$currentWeek->start_date, $currentWeek->end_date])
                ->orderBy('sw.date', 'asc')
                ->get();

            if (!$attendanceHistory) {
                $result = [];
            } else {
                $result = $attendanceHistory->map(function ($schedule) {
                    return [
                        "id" => $schedule->sw_id,
                        "date" => $schedule->entry_time,
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
                        "attendance" =>  [
                            "id" => $schedule->attendance_id,
                            "sakit" => $schedule->sakit,
                            "izin" => $schedule->izin,
                            "alpha" => $schedule->alpha,
                            "entry_time" => Carbon::parse($schedule->entry_time)->format('H:i:s'),
                            "is_changed" => (bool)$schedule->is_changed,
                            "lecturer_verified" => (bool) $schedule->lecturer_verified,
                        ],
                    ];
                });
            }
            return new ApiResource(true, 'Success', $result);
        } catch (Exception $e) {
            return new ApiResource(false, 'Failed to get history', $e->getMessage());
        }
    }
}
