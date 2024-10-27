<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface AttendanceContract{
    function validationAttendance(Request $request);
    function storeAttendance(Request $request);

}
