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


    function attendance(StoreAttendanceRequest $request){
        $validation = $this->attendanceContract->validationAttendance($request);
        if($validation){
            $result = $this->attendanceContract->storeAttendance($request);
            return $result;
        } else {
            return new ApiResource(false, 'Failed validation.',[]);

        }
    }
}
