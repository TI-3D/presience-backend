<?php

namespace App\Services;

use App\Contracts\AttendanceContract;
use App\Http\Resources\ApiResource;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceService implements AttendanceContract
{
    function validationAttendance(Request $request)
    {
        return true;
    }

    // This function makes it easier to enter attendance data, because there are several conditions that have different provisions.


    function storeAttendance(Request $request)
    {
        try {
            $student_id = Auth::id();
            $today = Carbon::today()->format('Y-m-d');
            $scheduleWeek = DB::table('schedule_weeks as sw')
                ->join('schedules as s', 'sw.schedule_id', '=', 's.id')
                ->join('rooms as r', 's.room_id', '=', 'r.id')
                ->join('lecturers as l', 's.lecturer_id', '=', 'l.id')
                ->join('courses as c', 's.course_id', '=', 'c.id')
                ->join('weeks as w', 'sw.week_id', '=', 'w.id')
                ->where('sw.date', $today)
                ->select('sw.*', 's.*', 'r.*', 'sw.id as sw_id', 'r.name as room_name', 'l.name as lecturer_name', 'c.*', 'c.name as course_name', 'w.*')
                ->first();
            if (!$scheduleWeek) {
                throw new Exception("No schedules found for today.");
            }
            if (!$scheduleWeek->opened_at || $scheduleWeek->closed_at) {
                throw new Exception("Attendance not available.");
            }
            $currentTime = Carbon::now();
            $openedAt = Carbon::parse($scheduleWeek->opened_at);
            $late = $this->lateCheck($currentTime,$openedAt,$scheduleWeek->time);
            if ($late > 0) {
                $request->validate([
                    'description' => 'required|string|max:255',
                    'evidence' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ]);
                // Create attendance data if the student are not on time
                $newAttendance = $this->createAttendance($student_id, $scheduleWeek, $late, $currentTime);
                $image = $request->file('evidence');
                $cloudinaryImage = $image->storeOnCloudinary('evidence');
                $permit = DB::table('permits')->insertGetId([
                    'start_date' => $today,
                    'end_date' => $today,
                    'type_permit' => 'izin',
                    'description' => $request->description,
                    'evidence' => $cloudinaryImage->getSecurePath(),
                    'image_public_id'=> $cloudinaryImage->getPublicId(),
                    'student_id' => $student_id
                ]);
                $permitDetail = DB::table('permit_details')->insert([
                    'permit_id' => $permit,
                    'schedule_week_id' => $scheduleWeek->sw_id,
                ]);
            } else {
                // Create attendance data if the student on time
                $newAttendance = $this->createAttendance($student_id, $scheduleWeek, $late, $currentTime);

            }
                $data =  [
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
                            "time" =>
                            $scheduleWeek->time
                        ]
                        ],
                    "attendance" => $newAttendance
                ];
            return new ApiResource(true, 'Success', $data);
        } catch (Exception $e) {
            return new ApiResource(false, 'Failed to do attendance', $e->getMessage());
        }
    }

    function createAttendance($student_id, $scheduleWeek, $alpha, $currentTime)
    {
        $attendanceId = DB::table('attendances')->insertGetId([
            'alpha' => $alpha,
            'student_id' => $student_id,
            'schedule_week_id' => $scheduleWeek->sw_id,
            'entry_time' => $currentTime,
        ]);

        return DB::table('attendances')->where('id', $attendanceId)->first();
    }

    function lateCheck($currentTime, $openedAt,$hours){
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
}
