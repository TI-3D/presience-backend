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
            $scheduleWeek = $this->scheduleService->getScheduleById($request->sw_id);
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
            "attendance" => $newAttendance
        ];

        return $data;
    }
}
