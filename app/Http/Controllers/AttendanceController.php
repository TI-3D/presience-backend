<?php

namespace App\Http\Controllers;

use App\Contracts\AttendanceContract;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AttendanceController extends Controller
{
    //
    protected AttendanceContract $attendanceContract;

    public function __construct(AttendanceContract $attendanceContract)
    {
        $this->attendanceContract = $attendanceContract;
    }

    public function getScheduleForToday(){
        $result = $this->attendanceContract->getScheduleForToday();
        return $result;
    }

}
