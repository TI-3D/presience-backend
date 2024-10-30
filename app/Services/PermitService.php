<?php

namespace App\Services;

use App\Contracts\PermitContract;
use App\Http\Requests\CurrentPermitRequest;
use App\Http\Resources\ApiResource;
use App\Services\AttendanceService;
use App\Services\ScheduleService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermitService implements PermitContract
{
    protected $scheduleService;
    protected $attendanceService;
    public function __construct(ScheduleService $scheduleService, AttendanceService $attendanceService)
    {
        $this->scheduleService = $scheduleService;
        $this->attendanceService = $attendanceService;
    }

    function currentPermit(CurrentPermitRequest $request)
    {
        try {
            $student_id = Auth::id();
            $sick = 0;
            $permit = 0;
            $scheduleWeek = $this->scheduleService->getScheduleById($request->sw_id);
            if (!$scheduleWeek) {
                throw new Exception("No schedules found for today.");
            }
            if (!$scheduleWeek->opened_at || $scheduleWeek->closed_at || $scheduleWeek->status === 'closed') {
                throw new Exception("Permit not available.");
            }
            if ($request->permit_type === 'sakit') {
                $sick = $scheduleWeek->time;
            } elseif ($request->permit_type === 'izin') {
                $permit = $scheduleWeek->time;
            }
            $newAttendance = $this->attendanceService->createAttendance($student_id, $scheduleWeek, 0, $sick, $permit, Carbon::now());
            $newPermit = $this->createPermit($request->file('evidence'),  $request->description, $student_id, $request->sw_id);
            $data = $this->attendanceService->prepareAttendanceData($scheduleWeek, $newAttendance);
            return new ApiResource(true, 'Success', $data);
        } catch (Exception $e) {
            return new ApiResource(false, 'Failed to do attendance permit', $e);
        }
    }

    public function createPermit($image, $description, $student_id, $sw_id)
    {
        $today = Carbon::today()->format('Y-m-d');
        $cloudinaryImage = $image->storeOnCloudinary('evidence');
        $permit = DB::table('permits')->insertGetId([
            'start_date' => $today,
            'end_date' => $today,
            'type_permit' => 'izin',
            'description' => $description,
            'evidence' => $cloudinaryImage->getSecurePath(),
            'image_public_id' => $cloudinaryImage->getPublicId(),
            'student_id' => $student_id
        ]);
        $permitDetail = DB::table('permit_details')->insert([
            'permit_id' => $permit,
            'schedule_week_id' => $sw_id,
        ]);
    }
}
