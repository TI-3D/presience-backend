<?php

namespace App\Services;

use App\Contracts\PermitContract;
use App\Http\Requests\CurrentPermitRequest;
use App\Http\Requests\PermitBeforeSchedule;
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
            $today = Carbon::today()->format('Y-m-d');
            $scheduleWeek = $this->scheduleService->getScheduleById([$request->sw_id]);
            if (!$scheduleWeek) {
                throw new Exception("No schedules found for today.");
            }
            if ($scheduleWeek->closed_at) {
                throw new Exception("Permit not available.");
            }
            if ($request->permit_type === 'sakit') {
                $sick = $scheduleWeek->time;
            } elseif ($request->permit_type === 'izin') {
                $permit = $scheduleWeek->time;
            }
            $newAttendance = $this->attendanceService->createAttendance($student_id, $scheduleWeek, 0, $sick, $permit, Carbon::now());
            $newPermit = $this->createPermit($request->file('evidence'), $today, $today,  $request->description, $student_id, $request->sw_id);
            $data = $this->attendanceService->prepareAttendanceData($scheduleWeek, $newAttendance);
            return new ApiResource(true, 'Success', $data);
        } catch (Exception $e) {
            return new ApiResource(false, 'Failed to do attendance permit', $e);
        }
    }

    public function createPermit($image, $start_date, $end_date, $description, $student_id, array $sw_ids)
    {
        $cloudinaryImage = $image->storeOnCloudinary('evidence');
        $permit = DB::table('permits')->insertGetId([
            'start_date' => $start_date,
            'end_date' => $end_date,
            'type_permit' => 'izin',
            'description' => $description,
            'evidence' => $cloudinaryImage->getSecurePath(),
            'image_public_id' => $cloudinaryImage->getPublicId(),
            'student_id' => $student_id
        ]);
        $permitDetails = [];
        foreach ($sw_ids as $sw_id) {
            $permitDetails[] = [
                'permit_id' => $permit,
                'schedule_week_id' => $sw_id,
            ];
        }
        DB::table('permit_details')->insert($permitDetails);
    }


    function permitBeforeSchedule(PermitBeforeSchedule $request)
    {
        try {
            $student_id = Auth::id();
            $sick = 0;
            $permit = 0;
            $scheduleWeek = $this->scheduleService->getScheduleById([$request->sw_id]);
            if (empty($scheduleWeeks)) {
                throw new Exception("No schedules found for today.");
            }
            $newAttendances = [];
            foreach ($scheduleWeeks as $scheduleWeek) {
                if (!$scheduleWeek->opened_at || $scheduleWeek->closed_at || $scheduleWeek->status === 'closed') {
                    throw new Exception("Permit not available for schedule id: {$scheduleWeek->id}");
                }

                if ($request->permit_type === 'sakit') {
                    $sick = $scheduleWeek->time;
                } elseif ($request->permit_type === 'izin') {
                    $permit = $scheduleWeek->time;
                }
                $newAttendance = $this->attendanceService->createAttendance($student_id, $scheduleWeek, 0, $sick, $permit, Carbon::now());
            }
            $newPermit = $this->createPermit($request->file('evidence'), $request->start_date, $request->end_date, $request->description, $student_id, $request->sw_id);
            return new ApiResource(true, 'Success', []);
        } catch (Exception $e) {
            return new ApiResource(false, 'Failed to do attendance permit before schedule', $e);
        }
    }
}
