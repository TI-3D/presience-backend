<?php

namespace App\Http\Controllers;

use App\Contracts\AttendanceInformationContract;
use App\Http\Controllers\Controller;
use App\Utils\WebResponseUtils;

class AttendanceInformationController extends Controller
{
    protected AttendanceInformationContract $service;

    public function __construct(AttendanceInformationContract $service)
    {
        $this->service = $service;
    }

    public function getAttendanceInformation()
    {
        $result = $this->service->getAttendanceInformation();
        return WebResponseUtils::response($result, "Success");
    }
}
