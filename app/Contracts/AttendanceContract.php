<?php

namespace App\Contracts;

use App\Http\Requests\StoreAttendanceRequest;
use Illuminate\Http\Request;

interface AttendanceContract{
    function validationAttendance(Request $request);
    function storeAttendance(StoreAttendanceRequest $request);
    public function getAttendanceHistoryByStudent(Request $request);

}
