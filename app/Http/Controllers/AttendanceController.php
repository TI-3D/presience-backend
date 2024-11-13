<?php

namespace App\Http\Controllers;

use App\Contracts\AttendanceContract;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Resources\ApiResource;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    protected AttendanceContract $attendanceContract;

    public function __construct(AttendanceContract $attendanceContract)
    {
        $this->attendanceContract = $attendanceContract;
    }


    function attendance(StoreAttendanceRequest $request)
    {
        $validation = $this->attendanceContract->validationAttendance($request);
        if ($validation['status'] === true) {
            $result = $this->attendanceContract->storeAttendance($request);
            return $result;
        } else {
            return response()->json([
                'success' => false,
                'message' => $validation['error'],
            ], 403);
        }
    }

    function historyAttendance(Request $request)
    {
        $result = $this->attendanceContract->getAttendanceHistoryByStudent($request);
        return $result;
    }
    function getHistoryByWeek(Request $request)
    {
        $result = $this->attendanceContract->getHistoryByWeek();
        return $result;
    }
}
